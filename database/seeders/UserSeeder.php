<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                [
                    'name'=>'Irfan',
                    'email'=>'irfan@gmail.com',
                    'password'=> bcrypt('irfanpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '0147896532',
                    'status' => 1,
                    ],
                [
                    'name'=>'Asyraf',
                    'email'=>'asyraf@gmail.com',
                    'password'=> bcrypt('asyrafpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '0154698873',
                    'status' => 1,
                    ],
                [
                    'name'=>'Fikri',
                    'email'=>'fikri@gmail.com',
                    'password'=> bcrypt('fikripass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011478963',
                    'status' => 1
                    ],
                [
                    'name'=>'Wan',
                    'email'=>'wan@gmail.com',
                    'password'=> bcrypt('wanpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011234567',
                    'status' => 1
                    ],
                [
                    'name'=>'Ahmad',
                    'email'=>'ahmad@gmail.com',
                    'password'=> bcrypt('ahmadpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011345678',
                    'status' => 1
                    ],
                [
                    'name'=>'Aiman',
                    'email'=>'aiman@gmail.com',
                    'password'=> bcrypt('aimanpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011456789',
                    'status' => 1
                    ],
                [
                    'name'=>'Adel',
                    'email'=>'adel@gmail.com',
                    'password'=> bcrypt('adelpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011567890',
                    'status' => 1
                    ],
                [
                    'name'=>'Luqman',
                    'email'=>'luqman@gmail.com',
                    'password'=> bcrypt('luqmanpass1234'),
                    'usertype' => 2,
                    'bunit' => 'ITMS',
                    'phonenum' => '011678901',
                    'status' => 1
                    ], 
                ];
        
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
