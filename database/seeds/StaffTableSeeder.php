<?php

use App\Models\Backend\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder{

    public function run()
    {
        if(Staff::where(['email'=>'oluwasegunmicheal10@gmail.com'])->count() <= 0){
            Staff::insert(
                [
                    'name' => 'Oluwasegun Micheal',
                    'email' => 'oluwasegunmicheal10@gmail.com',
                    'pnumber' => '08120129110',
                    'ptitle' => 'Software Developer',
                    'password' => Hash::make('oluwasegunmicheal10@gmail.com'),
                    'operation' => 'active',
                    'role'=>'1',
                    'accessRight'=>'All'
                ],
                [
                    'name' => 'Obidike Darlington',
                    'email' => 'Obidikedarlington@yahoo.com',
                    'pnumber' => '08120129110',
                    'ptitle' => 'Software Developer',
                    'password' => Hash::make('123456789'),
                    'operation' => 'active',
                    'role'=>'1',
                    'accessRight'=>'all'
                ],
                [
                    'name' => 'onlyone munachim',
                    'email' => 'onlyonemunachim@gmail.com',
                    'pnumber' => '08120129110',
                    'ptitle' => 'Software Developer',
                    'password' => Hash::make('123456789'),
                    'operation' => 'active',
                    'role'=>'1',
                    'accessRight'=>'all'
                ]
            );
        }
    }
}