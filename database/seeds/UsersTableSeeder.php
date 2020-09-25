<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Stalin Chacón',
            'email' => 'stalin.chacon@tars.dev',
            'document_number' => '80793167',
            'role_id'=> 1,
            'password' => Hash::make('80793167'),
            'status_id' => 1
        ]);
        User::create([
            'name' => 'Sebastián Ramírez',
            'email' => 'sebastian.ramirez@tars.dev',
            'document_number' => '1121871302',
            'role_id'=> 1,
            'password' => Hash::make('1121871302'),
            'status_id' => 1
        ]);
    }
}
