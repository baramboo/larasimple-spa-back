<?php

namespace Database\Seeders\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 2,
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 3,
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 4,
                'name' => 'Manager 1',
                'email' => 'manager1@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 5,
                'name' => 'Manager 2',
                'email' => 'manager2@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 6,
                'name' => 'Tester',
                'email' => 'tester@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 7,
                'name' => 'Lara Croft',
                'email' => 'lara.croft@mozgov.net',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 8,
                'name' => 'Gordon Freeman',
                'email' => 'gordon.freeman@maila.net',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ],
            [
                'id' => 9,
                'name' => 'Mickey Mouse',
                'email' => 'mike.mouse@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
            ]
        ];

        foreach ($data as $row) {
            $row['created_at'] = Carbon::now();

            DB::table('users')->insertOrIgnore($row);
        }

    }
}
