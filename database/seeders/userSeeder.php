<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'info@crewa.nl',
            'name' => 'jaap',
            'role_id' => '3',
            'password' => '$2y$12$xTQ0kqduIb18Ds3IwjCA9OLyfOsX3XTbaQPfWlSTANq58zx2wo0Ju'
        ]);
    }
}
