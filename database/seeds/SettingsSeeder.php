<?php

use App\Setting;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'type' => 'admin',
        ]);


    }
}
