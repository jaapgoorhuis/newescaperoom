<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'title' => 'Home pagina',
                'route' => 'index',
                'page_type' => 'pagebuilder',
                'is_removable' => 0,
                'is_visible' => 1,
                'is_active' => 1,
            ],
            [
                'title' => 'Offerte aanvragen',
                'route' => 'offerte-aanvragen',
                'page_type' => 'pagebuilder',
                'is_removable' => 0,
                'is_visible' => 1,
                'is_active' => 1,
            ]
        ]);
    }
}
