<?php

namespace Database\Seeders;

use App\Models\HR\Department;
use App\Models\HR\Designation;
use App\Models\Master\Bank;
use App\Models\Master\BloodType;
use App\Models\Master\Degree;
use App\Models\Master\Religion;
use App\Models\Regional\Language as RegionalLanguage;
use App\Models\User;
use App\Models\User\UserAddress;
use App\Models\User\UserBank;
use App\Models\User\UserEducation;
use App\Models\User\UserLanguage;
use App\Models\User\UserProfile;
use App\Models\User\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Corporate',
            ],
            [
                'name' => 'Individual',
            ],
        ];
        foreach ($types as $type) {
            UserType::firstOrCreate([
                'name' => $type['name'],
            ]);
        }

        $bloodTypeId = $this->ensureBloodTypeId('AB');
        $religionId = $this->ensureReligionId('Islam');

        $users = [
            [
                'name' => 'Rizky Ramadhan',
                'username' => $this->generateUniqueUsernameFromName('Rizky Ramadhan'),
                'email' => 'rizky.ramadhan@yex.co.id',
                'phone' => '87785485559',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
            [
                'name' => 'Ryandra Gunawan',
                'username' => $this->generateUniqueUsernameFromName('Ryandra Gunawan'),
                'email' => 'ryandra.gunawan@yex.co.id',
                'phone' => '85793385150',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
            [
                'name' => 'Fazli Rausyan Fikri',
                'username' => $this->generateUniqueUsernameFromName('Fazli Rausyan Fikri'),
                'email' => 'fazli.rausyan@yex.co.id',
                'phone' => '82112497009',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
            [
                'name' => 'Dani Firmansah',
                'username' => $this->generateUniqueUsernameFromName('Dani Firmansah'),
                'email' => 'dani.firmansah@yex.co.id',
                'phone' => '85158524200',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
        ];

        $sa = Role::find(1);
        $direktur = Role::find(2);

        $userMap = [];
        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
            $userMap[$userData['email']] = $user->id;

            if ($user->wasRecentlyCreated) {
                if ($user->email === 'rizky.ramadhan@yex.co.id' && $sa) {
                    $user->assignRole($sa);
                } elseif ($direktur) {
                    $user->assignRole($direktur);
                }
            }
        }

        $idToEmail = [
            1 => 'rizky.ramadhan@yex.co.id',
            2 => 'ryandra.gunawan@yex.co.id',
            3 => 'fazli.rausyan@yex.co.id',
            4 => 'dani.firmansah@yex.co.id',
        ];

        $address = [
            [
                'user_id' => 1,
                'label' => 'Rumah',
                'address_line1' => 'Komplek Permata Buah Batu',
                'address_line2' => 'Blok C 15B',
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => 49261,
                'subdistrict_id' => 1106,
                'village_id' => 73274,
                'postal_code' => 40287,
                'is_default' => true,
            ],
            [
                'user_id' => 2,
                'label' => 'Rumah',
                'address_line1' => 'Jl. Adipati Agung',
                'address_line2' => 'Kos Sehati Baleendah',
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => 49261,
                'subdistrict_id' => 884,
                'village_id' => 79599,
                'postal_code' => 40375,
                'is_default' => true,
            ],
            [
                'user_id' => 3,
                'label' => 'Rumah',
                'address_line1' => 'Komp Bojong Malaka Indah RT08 RW16',
                'address_line2' => null,
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => 49261,
                'subdistrict_id' => 884,
                'village_id' => 79599,
                'postal_code' => 40375,
                'is_default' => true,
            ],
            [
                'user_id' => 4,
                'label' => 'Rumah',
                'address_line1' => 'Tarate 5 Rt 08 Rw 02',
                'address_line2' => null,
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => 49261,
                'subdistrict_id' => 1160,
                'village_id' => 66173,
                'postal_code' => 40239,
                'is_default' => true,
            ],
        ];

        $banks = [
            [
                'user_id' => 1,
                'bank_id' => 15,
                'account_number' => 8470614391,
                'account_name' => 'Rizky Ramadhan',
                'is_default' => true,
            ],
            [
                'user_id' => 2,
                'bank_id' => 146,
                'account_number' => 901272827440,
                'account_name' => 'Ryandra Gunawan',
                'is_default' => true,
            ],
            [
                'user_id' => 3,
                'bank_id' => 148,
                'account_number' => 82112497009,
                'account_name' => 'Fazli Rausyan Fikri',
                'is_default' => true,
            ],
            [
                'user_id' => 4,
                'bank_id' => 146,
                'account_number' => 901162614605,
                'account_name' => 'Dani Firmansah',
                'is_default' => true,
            ],
        ];

        $languages = [
            [
                'user_id' => 1,
                'language_id' => 40,
            ],
            [
                'user_id' => 1,
                'language_id' => 64,
            ],
            [
                'user_id' => 2,
                'language_id' => 64,
            ],
            [
                'user_id' => 3,
                'language_id' => 64,
            ],
            [
                'user_id' => 4,
                'language_id' => 64,
            ],
        ];

        $educations = [
            [
                'user_id' => 1,
                'degree_id' => 8,
                'major' => null,
                'university' => null,
                'graduation_date' => null,
            ],
            [
                'user_id' => 1,
                'degree_id' => 6,
                'major' => null,
                'university' => null,
                'graduation_date' => null,
            ],
            [
                'user_id' => 1,
                'degree_id' => 4,
                'major' => null,
                'university' => null,
                'graduation_date' => null,
            ],
            [
                'user_id' => 1,
                'degree_id' => 3,
                'major' => null,
                'university' => null,
                'graduation_date' => null,
            ],
            [
                'user_id' => 2,
                'degree_id' => 9,
                'major' => 'Teknik Informatika',
                'university' => 'Universitas Teknologi Bandung',
                'graduation_date' => '01-01-2029',
            ],
            [
                'user_id' => 2,
                'degree_id' => 6,
                'major' => 'Rekayasa Perangkat Lunak',
                'university' => 'SMK Assalaam Bandung',
                'graduation_date' => '01-06-2025',
            ],
            [
                'user_id' => 2,
                'degree_id' => 4,
                'major' => '-',
                'university' => 'SMPN 2 Margahayu',
                'graduation_date' => '01-06-2022',
            ],
            [
                'user_id' => 2,
                'degree_id' => 3,
                'major' => '-',
                'university' => 'SDn Gentra TKI 2',
                'graduation_date' => '01-06-2019',
            ],
            [
                'user_id' => 3,
                'degree_id' => 6,
                'major' => 'Rekayasa Perangkat Lunak',
                'university' => 'SMK Assalaam Bandung',
                'graduation_date' => '01-01-2026',
            ],
            [
                'user_id' => 4,
                'degree_id' => 9,
                'major' => 'Teknik Informatika',
                'university' => 'Universitas Teknologi Bandung',
                'graduation_date' => '01-01-2029',
            ],
            [
                'user_id' => 4,
                'degree_id' => 6,
                'major' => 'Rekayasa Perangkat Lunak',
                'university' => 'SMK Assalaam Bandung',
                'graduation_date' => '01-06-2025',
            ],
            [
                'user_id' => 4,
                'degree_id' => 4,
                'major' => '-',
                'university' => 'MTs Nurul Iman',
                'graduation_date' => '01-06-2022',
            ],
            [
                'user_id' => 4,
                'degree_id' => 3,
                'major' => '-',
                'university' => 'SDn Kota Baru',
                'graduation_date' => '01-06-2019',
            ],
        ];

        $profiles = [
            [
                'user_id' => 1,
                'gender' => 'male',
                'marital_status' => 'married',
                'blood_type_id' => 1,
                'religion_id' => 1,
                'national_id' => '3273131502960004',
                'tax_id' => '929205938424000',
                'passport_number' => null,
                'passport_expiry' => null,
                'employee_id' => '112105210001',
                'department_id' => 1,
                'designation_id' => 3,
                'joining_date' => '2021-05-21',
                'status' => 'active',
                'reporting_to' => null,
                'hourly_rate' => null,
                'basic_salary' => null,
                'about' => null,
                'created_by' => null,
            ],
            [
                'user_id' => 2,
                'gender' => 'male',
                'marital_status' => 'single',
                'blood_type_id' => 1,
                'religion_id' => 1,
                'national_id' => '3275062505070006',
                'tax_id' => null,
                'passport_number' => null,
                'passport_expiry' => null,
                'employee_id' => '590101260004',
                'department_id' => 5,
                'designation_id' => 9,
                'joining_date' => '2026-01-01',
                'status' => 'active',
                'reporting_to' => 1,
                'hourly_rate' => null,
                'basic_salary' => null,
                'about' => null,
                'created_by' => 1,
            ],
            [
                'user_id' => 3,
                'gender' => 'male',
                'marital_status' => 'single',
                'blood_type_id' => 1,
                'religion_id' => 1,
                'national_id' => '3204120107070003',
                'tax_id' => null,
                'passport_number' => null,
                'passport_expiry' => null,
                'employee_id' => '610101260005',
                'department_id' => 6,
                'designation_id' => 10,
                'joining_date' => '2026-01-01',
                'status' => 'active',
                'reporting_to' => 2,
                'hourly_rate' => null,
                'basic_salary' => null,
                'about' => null,
                'created_by' => 1,
            ],
            [
                'user_id' => 4,
                'gender' => 'male',
                'marital_status' => 'single',
                'blood_type_id' => 1,
                'religion_id' => 1,
                'national_id' => '3204120107070003',
                'tax_id' => null,
                'passport_number' => null,
                'passport_expiry' => null,
                'employee_id' => '810101260006',
                'department_id' => 8,
                'designation_id' => 10,
                'joining_date' => '2026-01-01',
                'status' => 'active',
                'reporting_to' => 2,
                'hourly_rate' => null,
                'basic_salary' => null,
                'about' => 'Saya adalah CTO yang berfokus pada strategi teknologi, pengembangan produk, dan arsitektur sistem yang scalable. Saya memimpin tim engineering untuk membangun aplikasi modern dengan standar code yang rapi, aman, dan mudah dikembangkan. Saya terbiasa mengambil keputusan teknis, mengatur workflow tim, serta memastikan teknologi selaras dengan kebutuhan bisnis.',
                'created_by' => 1,
            ],
        ];

        foreach ($address as $data) {
            $data['user_id'] = $userMap[$idToEmail[$data['user_id']]];
            UserAddress::updateOrCreate(
                ['user_id' => $data['user_id'], 'label' => $data['label']],
                $data
            );
        }

        foreach ($banks as $data) {
            $data['user_id'] = $userMap[$idToEmail[$data['user_id']]];
            $data['bank_id'] = $this->findBankId($data['bank_id']);

            if ($data['bank_id']) {
                UserBank::updateOrCreate(
                    ['user_id' => $data['user_id'], 'account_number' => $data['account_number']],
                    $data
                );
            }
        }

        foreach ($languages as $data) {
            $data['user_id'] = $userMap[$idToEmail[$data['user_id']]];
            $data['language_id'] = $this->findLanguageId($data['language_id']);

            if ($data['language_id']) {
                UserLanguage::updateOrCreate(
                    ['user_id' => $data['user_id'], 'language_id' => $data['language_id']],
                    $data
                );
            }
        }

        foreach ($educations as $data) {
            $data['user_id'] = $userMap[$idToEmail[$data['user_id']]];
            $data['degree_id'] = $this->findDegreeId($data['degree_id']);

            if (isset($data['graduation_date']) && $data['graduation_date']) {
                try {
                    $data['graduation_date'] = \Illuminate\Support\Carbon::parse($data['graduation_date'])->toDateString();
                } catch (\Exception $e) {
                    $data['graduation_date'] = null;
                }
            }

            if ($data['degree_id']) {
                UserEducation::updateOrCreate(
                    ['user_id' => $data['user_id'], 'degree_id' => $data['degree_id'], 'major' => $data['major']],
                    $data
                );
            }
        }

        foreach ($profiles as $data) {
            $data['user_id'] = $userMap[$idToEmail[$data['user_id']]];
            $data['blood_type_id'] = $bloodTypeId;
            $data['religion_id'] = $religionId;
            $data['department_id'] = $this->findDepartmentId($data['department_id']);
            $data['designation_id'] = $this->findDesignationId($data['designation_id']);

            if (isset($data['reporting_to']) && isset($idToEmail[$data['reporting_to']])) {
                $data['reporting_to'] = $userMap[$idToEmail[$data['reporting_to']]];
            }
            if (isset($data['created_by']) && isset($idToEmail[$data['created_by']])) {
                $data['created_by'] = $userMap[$idToEmail[$data['created_by']]];
            }

            UserProfile::updateOrCreate(
                ['user_id' => $data['user_id']],
                $data
            );
        }
    }

    private function ensureBloodTypeId(string $name): int
    {
        $bloodType = BloodType::query()->where('name', $name)->first();

        if ($bloodType !== null) {
            return $bloodType->id;
        }

        $bloodType = new BloodType;
        $bloodType->name = $name;
        $bloodType->save();

        return $bloodType->id;
    }

    private function ensureReligionId(string $name): int
    {
        $religion = Religion::query()->where('name', $name)->first();

        if ($religion !== null) {
            return $religion->id;
        }

        $religion = new Religion;
        $religion->name = $name;
        $religion->save();

        return $religion->id;
    }

    private function generateUniqueUsernameFromName(string $name): string
    {
        $base = Str::slug($name);

        if ($base === '') {
            $base = 'user';
        }

        // batas panjang username (sesuai aturan kamu)
        $base = Str::lower(Str::substr($base, 0, 20));

        $username = $base;
        $i = 1;

        while (User::where('username', $username)->exists()) {
            $suffix = '-'.$i;
            $maxBaseLen = 20 - strlen($suffix);

            $username = Str::substr($base, 0, max(1, $maxBaseLen)).$suffix;
            $i++;
        }

        return $username;
    }

    private function findBankId(int $oldId): ?int
    {
        if ($oldId === 15) {
            return Bank::where('name', 'like', '%CENTRAL ASIA%')->first()?->id;
        }
        if ($oldId === 146) {
            return Bank::where('name', 'like', '%MANDIRI%')->where('name', 'like', '%SYARIAH%')->first()?->id;
        }
        if ($oldId === 147) {
            return Bank::where('name', 'like', '%SYARIAH%')->where('name', 'like', '%BUKOPIN%')->first()?->id;
        }

        return Bank::find($oldId)?->id;
    }

    private function findLanguageId(int $oldId): ?int
    {
        if ($oldId === 40) {
            return RegionalLanguage::where('name', 'English')->first()?->id;
        }
        if ($oldId === 64) {
            return RegionalLanguage::where('name', 'Indonesian')->first()?->id;
        }

        return RegionalLanguage::find($oldId)?->id;
    }

    private function findDegreeId(int $oldId): ?int
    {
        $map = [
            3 => 'Sekolah Dasar / Sederajat',
            4 => 'Sekolah Menengah Pertama / Sederajat',
            6 => 'Sekolah Menengah Kejuruan / Sederajat',
            8 => 'Akademi / Diploma III / Sarjana Muda',
            9 => 'Diploma IV / Strata I',
        ];

        if (isset($map[$oldId])) {
            return Degree::where('name', $map[$oldId])->first()?->id;
        }

        return Degree::find($oldId)?->id;
    }

    private function findDepartmentId(int $oldId): ?int
    {
        $map = [
            1 => 'RUPS / Pemegang Saham',
            5 => 'Management',
            6 => 'Operational & Corporate Services',
            8 => 'Technology & Engineering',
        ];

        if (isset($map[$oldId])) {
            return Department::where('name', $map[$oldId])->first()?->id;
        }

        return Department::find($oldId)?->id;
    }

    private function findDesignationId(int $oldId): ?int
    {
        $map = [
            3 => 'Komisaris Utama',
            9 => 'Direktur Utama',
            10 => 'Direktur',
        ];

        if (isset($map[$oldId])) {
            return Designation::where('name', $map[$oldId])->first()?->id;
        }

        return Designation::find($oldId)?->id;
    }
}
