<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class, 'email'),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // Retry untuk mengatasi race condition (dua user daftar bersamaan)
        for ($attempt = 1; $attempt <= 20; $attempt++) {
            $username = $this->generateUniqueUsernameFromName($input['name']);

            try {
                return User::create([
                    'user_type_id' => $input['user_type_id'],
                    'name' => $input['name'],
                    'username' => $username,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                ]);
            } catch (QueryException $e) {
                if (($e->errorInfo[0] ?? null) === '23000') {
                    $msg = $e->getMessage();

                    // retry cuma kalau unique username
                    if (str_contains($msg, 'users_username_unique') || str_contains($msg, 'username')) {
                        continue;
                    }

                    // selain itu (FK/email/dll) jangan retry
                    throw $e;
                }

                throw $e;
            }
        }

        throw new \RuntimeException('Gagal membuat user: tidak bisa menghasilkan username unik setelah beberapa percobaan.');
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
