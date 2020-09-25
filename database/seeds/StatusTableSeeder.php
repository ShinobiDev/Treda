<?php

use Illuminate\Database\Seeder;
use App\Status;


class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Activo',
            'description' => 'Estado activo'
        ]);
        Status::create([
            'name' => 'Inactivo',
            'description' => 'Estado inactivo'
        ]);
    }
}
