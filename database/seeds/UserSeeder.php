<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('roles');
        foreach (config('seed.users') as $item) {
            $roleKey = array_key_exists('role', $item) ? array_search($item['role'], $roles) : null;
            $user = User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => Hash::make($item['password']),
                'role_key' => $roleKey,
            ]);
        }
    }
}
