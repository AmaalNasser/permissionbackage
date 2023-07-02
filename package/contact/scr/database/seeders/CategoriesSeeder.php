<?php

namespace Database\Seeders;

use App\Models\ComplainsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ComplainsCategory = [
            [
                'name' => 'Technical',
                'description' => 'example text',
            ],
            [
                'name' => 'General',
                'description' => 'example text',
            ],

        ];
        foreach ($ComplainsCategory as $key => $value) {

            ComplainsCategory::create($value);
        }
    }
}
