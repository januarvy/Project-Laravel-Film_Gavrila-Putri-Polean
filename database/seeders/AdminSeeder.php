<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\{User, Profile};
use RuntimeException;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! is_string($email) || trim($email) === '' || ! is_string($password) || $password === '') {
            throw new RuntimeException('Set ADMIN_EMAIL and ADMIN_PASSWORD in your .env file before seeding the administrator.');
        }

        $this->ensureAdmin($email, $password, env('ADMIN_NAME', 'Administrator'), $faker);
    }

    /**
     * Create the admin user if it does not exist yet.
     */
    private function ensureAdmin(string $email, string $password, string $name, $faker): void
    {
        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
                'role_id' => 2,
                'profile_id' => Profile::create([
                    'alamat' => $faker->address,
                    'umur' => $faker->numberBetween(1, 50),
                    'bio' => 'administrator',
                ])->id,
            ]
        );
    }
}
