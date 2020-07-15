<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("users")->insert([
            'name' => 'müşteri',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123),
            'remember_token' => Str::random(10),
            'api_token' => Str::random(60)
        ]);

        DB::table("users")->insert([
            'name' => 'müşteri 2',
            'email' => 'admin2@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123),
            'remember_token' => Str::random(10),
            'api_token' => Str::random(60)
        ]);

        DB::table("users")->insert([
            'name' => 'müşteri 3',
            'email' => 'admin3@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123),
            'remember_token' => Str::random(10),
            'api_token' => Str::random(60)
        ]);
    }
}
