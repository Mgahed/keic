<?php

namespace Database\Seeders;

use App\Models\AcademicStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => [
                    'en' => 'Kindergarten',
                    'ar' => 'روضة',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Primary',
                    'ar' => 'ابتدائي',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Middle School',
                    'ar' => 'إعدادي',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'High School',
                    'ar' => 'ثانوي',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'University',
                    'ar' => 'جامعة',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $item) {
            AcademicStage::create($item);
        }
    }
}
