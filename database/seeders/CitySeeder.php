<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guj = State::where('name', 'Gujarat')->first();
        $maha = State::where('name', 'Maharashtra')->first();

        City::create(['name' => 'Surat', 'state_id' => $guj->id]);
        City::create(['name' => 'Ahmadabad', 'state_id' => $guj->id]);

        City::create(['name' => 'Pune', 'state_id' => $maha->id]);
        City::create(['name' => 'Mumbai', 'state_id' => $maha->id]);
    }
}
