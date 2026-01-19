<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\User\UserBank;
use App\Models\User\UserType;
use App\Models\User\UserSkill;
use App\Models\Master\Religion;
use App\Models\User\UserResume;
use App\Models\User\UserSocial;
use Illuminate\Database\Seeder;
use App\Models\Master\BloodType;
use App\Models\User\UserAddress;
use App\Models\User\UserProfile;
use App\Models\User\UserLanguage;
use App\Models\User\UserEducation;
use App\Models\User\UserPortfolio;
use Spatie\Permission\Models\Role;
use App\Models\User\UserCertificate;
use Illuminate\Support\Facades\Hash;
use App\Models\User\UserNotification;

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
            UserType::create([
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
                'phone' => '1',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
            [
                'name' => 'Fazli Rausyan Fikri',
                'username' => $this->generateUniqueUsernameFromName('Fazli Rausyan Fikri'),
                'email' => 'fazli.rausyan@yex.co.id',
                'phone' => '2',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
            [
                'name' => 'Dani Firmansah',
                'username' => $this->generateUniqueUsernameFromName('Dani Firmansah'),
                'email' => 'dani.firmansah@yex.co.id',
                'phone' => '3',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ],
        ];
        $sa = Role::find(1);
        $direktur = Role::find(2);
        // $user->assignRole($direktur);

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
                'address_line1' => '',
                'address_line2' => '',
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => '',
                'subdistrict_id' => '',
                'village_id' => '',
                'postal_code' => '',
                'is_default' => true,
            ],
            [
                'user_id' => 3,
                'label' => 'Rumah',
                'address_line1' => '',
                'address_line2' => '',
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => '',
                'subdistrict_id' => '',
                'village_id' => '',
                'postal_code' => '',
                'is_default' => true,
            ],
            [
                'user_id' => 4,
                'label' => 'Rumah',
                'address_line1' => '',
                'address_line2' => '',
                'country_id' => 103,
                'state_id' => 1684,
                'city_id' => '',
                'subdistrict_id' => '',
                'village_id' => '',
                'postal_code' => '',
                'is_default' => true,
            ],
        ];

        $banks = [
            [
                'user_id' => 1,
                'bank_id' => 15,
                'account_number' => 847,
                'account_name' => 'Rizky Ramadhan',
                'is_default' => true,
            ],
            [
                'user_id' => '',
                'bank_id' => '',
                'account_number' => '',
                'account_name' => '',
                'is_default' => '',
            ],
            [
                'user_id' => '',
                'bank_id' => '',
                'account_number' => '',
                'account_name' => '',
                'is_default' => '',
            ],
            [
                'user_id' => '',
                'bank_id' => '',
                'account_number' => '',
                'account_name' => '',
                'is_default' => '',
            ],
        ];

        $languages = [
            [
                'user_id' => '',
            ]
        ];

        $educations = [
            [
                'user_id' => 1,
                'degree_id' => 3,
                'major' => '',
                'university' => '',
                'graduation_date' => '',
            ],
            [
                'user_id' => 1,
                'degree_id' => 4,
                'major' => '',
                'university' => '',
                'graduation_date' => '',
            ],
            [
                'user_id' => 1,
                'degree_id' => 6,
                'major' => '',
                'university' => '',
                'graduation_date' => '',
            ],
            [
                'user_id' => 1,
                'degree_id' => 8,
                'major' => '',
                'university' => '',
                'graduation_date' => '',
            ],
        ];

        $profiles = [
            [
                'user_id' => '',
                'gender' => '',
                'marital_status' => '',
                'blood_type_id' => '',
                'religion_id' => '',
                'national_id' => '',
                'tax_id' => '',
                'passport_number' => '',
                'passport_expiry' => '',
                'employee_id' => '',
                'department_id' => '',
                'designation_id' => '',
                'joining_date' => '',
                'status' => '',
                'reporting_to' => '',
                'hourly_rate' => '',
                'basic_salary' => '',
                'about' => '',
                'created_by' => '',
            ],
        ];
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
}
