<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeeder extends Seeder
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
                'name_country'=>'VietNam',
            ],
            [
                'name_country'=>'Korea',
            ],
            [
                'name_country'=>'Japan',
            ],
            [
                'name_country'=>'Spain',
            ],
            [
                'name_country'=>'England',
            ],
            [
                'name_country'=>'Italy',
            ],
            [
                'name_country'=>'Australia',
            ],
            [
                'name_country'=>'Singapo',
            ],
            [
                'name_country'=>'Canada',
            ],
            [
                'name_country'=>'America',
            ]
        ];
        DB::table('country')->insert($data);
    }
}
