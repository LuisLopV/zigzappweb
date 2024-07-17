<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('travel_statuses')->insert([
            ['status' => 'Esperando'],
            ['status' => 'En Curso'],
            ['status' => 'Completado'],
        ]);
    }
}
