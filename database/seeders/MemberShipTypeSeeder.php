<?php

namespace Database\Seeders;

use App\Models\MemberShipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberShipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => [
                    'en' => '1 Month',
                    'ar' => '1 شهر',
                ],
                'weight_in_days' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => '3 Month',
                    'ar' => '3 شهور',
                ],
                'weight_in_days' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => '6 Month',
                    'ar' => '6 شهور',
                ],
                'weight_in_days' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => '1 Year',
                    'ar' => '1 سنة',
                ],
                'weight_in_days' => 365,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $item) {
            MemberShipType::create($item);
        }
    }
}
