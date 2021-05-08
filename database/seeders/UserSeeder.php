<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'laravelmailto8@gmail.com',
            'password' => bcrypt('pa55word2021'),
        ]);

        $admin->assignRole('admin');

        $admin = User::create([
            'name' => 'Misha',
            'email' => 'mishaprimaresty@gmail.com',
            'password' => bcrypt('123456782021'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Tjua',
            'email' => 'epc.tju@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'name' => 'Spot',
            'email' => 'spotakun2020@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'name' => 'Fahre',
            'email' => 'fahre.tigakomadua@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
