<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'username'=>'vinh',
            'email'=>'tranvinh1109@gmail.com',
            'password'=>bcrypt('vinhvinh'),
            'phone'=>'0969981849',
            'level'=>1
        ];
        DB::table('user_shop')->insert($data);
        //
    }
}
