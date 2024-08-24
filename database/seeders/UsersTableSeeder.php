<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Abdelrhman Mgahed',
                'email' => '29805180200352@mgahed.com',
                'email_verified_at' => NULL,
                'mobile' => '01100479096',
                'nid' => '29805180200352',
                'gender' => 'M',
                'is_student' => false,
                'birth_date' => '1998-05-18',
                'password' => Hash::make('123456789'),
                'remember_token' => NULL,
                'membership_number' => 1,
                'created_at' => '2024-02-16 15:02:42',
                'updated_at' => '2024-02-16 15:02:42',
                'deleted_at' => NULL,
            ),
        ));

    }
}
