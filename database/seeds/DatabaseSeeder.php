<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'thangdeptrai@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'type' => 1,
            'status' => 1
        ]);
    }
}
