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
        $user = User::create([
            'name' => 'admin',
            'email' => 'customer@demo.com',
            'phone' => '010000000000',
            'lat' => 'aaaa aaa aaa',
            'lng' => 'aaaa aaa aaa',
            'password' => '123456',
        ]);
    }
}
