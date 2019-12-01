<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'first_name' => 'Ubunifu',
                'last_name' => 'Systems',
                'name' => "Ubunifu Systems",
                'email' => 'info@ubunifu.systems',
                'username' => 'ubunifu',
                'password' => bcrypt('secret'),
                'department' => "ICT",
                'wholename' => "System Administrator",
                'contactno' => "0775194615",
                'role_id' => 1,
                'role' => '1',
                'isBACSec' => '0'
            ],
            [
                'first_name' => 'Oluka',
                'last_name' => 'Bruno',
                'name' => "Oluka Bruno",
                'email' => 'oluka@ubunifu.systems',
                'username' => 'olukabruno',
                'password' => bcrypt('secret'),
                'department' => "ICT",
                'wholename' => "System Analyst",
                'contactno' => "0775194615",
                'role_id' => 1,
                'role' => '1',
                'isBACSec' => '0'
            ],
            [
                'first_name' => 'Kizito',
                'last_name' => 'Innocent',
                'name' => "KizitoInnocent",
                'email' => 'kizmag@gmail.com',
                'username' => 'olukabruno',
                'password' => bcrypt('secret'),
                'department' => "ICT",
                'wholename' => "System User",
                'contactno' => "114/154",
                'role' => '0',
                'role_id' => 2,
                'isBACSec' => '0'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
