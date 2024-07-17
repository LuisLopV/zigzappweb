<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Pasajero', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conductor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
