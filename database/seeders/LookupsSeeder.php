<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

        ];
        Lookup::insert($data);
    }
}
