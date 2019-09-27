<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Abdulrahman',
            'middle_name' => '',
            'last_name' => 'Faid',
            'email' => 'abdurrhmanfaid@gmail.com',
            'password' => bcrypt('hguhf lk hgkj1088'),
            'email_verified_at' => now(),
            'role' => 'super_admin',
            'country_id' => 69
        ]);
    }
}
