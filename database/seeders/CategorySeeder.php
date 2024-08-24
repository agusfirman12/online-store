<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Alat Tulis',
            'description' => 'Alat Tulis Kantor dan Sekolah',
            'status' => 'active',
        ],);

        ProductCategory::create([
            'name' => 'Pakaian ',
            'description' => 'pakaian kuliah dan sekolah',
            'status' => 'active',
        ],);
    }
}
