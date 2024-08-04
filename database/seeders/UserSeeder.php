<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {

            $userID = DB::table('users')->insertGetId([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
            ]);

            DB::table('user_details')->insert([
                'user_id' => $userID,
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber()
            ]);

        }
    }
}
