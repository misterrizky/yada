<?php

namespace Database\Seeders\Master\School;

use App\Models\Regional\City;
use App\Models\Regional\State;
use App\Models\Regional\Subdistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SDSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();

        $url = 'https://api-sekolah-indonesia.vercel.app/sekolah/SD';
        $perPage   = 50000;   // boleh, tapi kalau memory berat turunkan (mis. 5000/10000)
        $batchSize = 2000;    // sesuaikan (1000-5000 biasanya aman)

        // =========================
        // 1) PRELOAD MASTER LOOKUPS
        // =========================
        $stateMap = State::query()
            ->select('id', 'name')
            ->get()
            ->mapWithKeys(fn ($s) => [$this->normProvince($s->name) => $s->id])
            ->all();

        $cities = City::query()->select('id', 'state_id', 'name')->get();

        // cityMap[state_id][normalized_city] = city_id
        $cityMap = [];
        // fallback: normalized_city => city_id (kalau state tidak ketemu)
        $cityByName = [];

        foreach ($cities as $c) {
            $key = $this->normCity($c->name);
            $cityMap[$c->state_id][$key] = $c->id;
            $cityByName[$key] ??= $c->id; // ambil pertama sebagai fallback
        }

        $subs = Subdistrict::query()->select('id', 'city_id', 'name')->get();

        // subMap[city_id][normalized_subdistrict] = sub_id
        $subMap = [];
        // fallback: normalized_subdistrict => sub_id
        $subByName = [];

        foreach ($subs as $sd) {
            $key = $this->normSubdistrict($sd->name);
            $subMap[$sd->city_id][$key] = $sd->id;
            $subByName[$key] ??= $sd->id;
        }

        // =========================
        // 2) FETCH TOTAL
        // =========================
        $resp = Http::timeout(60)->retry(3, 500)->get($url, [
            'page' => 1,
            'perPage' => $perPage,
        ])->json();

        $total = (int)($resp['total_data'] ?? 0);
        if ($total <= 0) return;

        $totalPages = (int)ceil($total / $perPage);

        // =========================
        // 3) LOOP PAGES + BULK INSERT
        // =========================
        $rows = [];
        $ts = now()->toDateTimeString();

        for ($page = 1; $page <= $totalPages; $page++) {
            $resp = Http::timeout(120)->retry(3, 500)->get($url, [
                'page' => $page,
                'perPage' => $perPage,
            ])->json();

            $dataSekolah = $resp['dataSekolah'] ?? [];
            if (!$dataSekolah) continue;

            foreach ($dataSekolah as $item) {
                $stateKey = $this->normProvince($item['propinsi'] ?? '');
                $stateId  = $stateMap[$stateKey] ?? null;

                $cityKey = $this->normCity($item['kabupaten_kota'] ?? '');
                $cityId  = $stateId
                    ? ($cityMap[$stateId][$cityKey] ?? null)
                    : ($cityByName[$cityKey] ?? null);

                $subKey = $this->normSubdistrict($item['kecamatan'] ?? '');
                $subId  = $cityId
                    ? ($subMap[$cityId][$subKey] ?? null)
                    : ($subByName[$subKey] ?? null);

                // Skip kalau NPSN kosong (opsional)
                $npsn = $item['npsn'] ?? null;
                if (!$npsn) continue;

                $rows[] = [
                    'npsn' => $npsn,
                    'degree_id' => 3,
                    'code' => $item['id'] ?? null,
                    'state_id' => $stateId,
                    'city_id' => $cityId,
                    'subdistrict_id' => $subId,
                    'name' => $item['sekolah'] ?? null,
                    'address' => $item['alamat_jalan'] ?? null,
                    'lat' => $item['lintang'] ?? null,
                    'lng' => $item['bujur'] ?? null,
                    'created_at' => $ts,
                    'updated_at' => $ts,
                ];

                if (count($rows) >= $batchSize) {
                    // Cepat: hanya insert jika belum ada (butuh UNIQUE index di npsn)
                    DB::table('schools')->insertOrIgnore($rows);
                    $rows = [];
                }
            }
        }

        if ($rows) {
            DB::table('schools')->insertOrIgnore($rows);
        }

        // Kalau kamu justru ingin data existing ikut di-update,
        // ganti insertOrIgnore di atas jadi:
        //
        // DB::table('schools')->upsert(
        //   $rows,
        //   ['npsn'],
        //   ['degree_id','code','state_id','city_id','subdistrict_id','name','address','lat','lng','updated_at']
        // );
    }

    private function normProvince(string $value): string
    {
        $v = Str::of($value)
            ->replace(['Prov. ', 'Prov ', '.'], '')
            ->trim()
            ->lower();

        return (string)$v;
    }

    private function normCity(string $value): string
    {
        $v = Str::of($value)
            ->replace(['Kab. ', 'Kab ', 'Kota '], '')
            ->trim()
            ->lower();

        return (string)$v;
    }

    private function normSubdistrict(string $value): string
    {
        $v = Str::of($value)
            ->replace(['Kec. ', 'Kec '], '')
            ->trim()
            ->lower();

        return (string)$v;
    }
}
