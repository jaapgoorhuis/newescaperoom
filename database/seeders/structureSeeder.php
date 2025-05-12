<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class structureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filter_value')->insert(
            [
                [
                'filter_id'  => '1',
                'title' => 'Hout',
                ],
                [
                    'filter_id'  => '1',
                    'title' => 'Natuursteen & Beton',
                ],
                [
                    'filter_id'  => '1',
                    'title' => 'Stof & Leer',
                ],
                [
                    'filter_id'  => '1',
                    'title' => 'Metallic',
                ],
                [
                    'filter_id'  => '1',
                    'title' => 'Grafisch',
                ],
                [
                    'filter_id'  => '1',
                    'title' => "Uni's",
                ]
            ]
        );
    }
}
