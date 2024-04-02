<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => 'primary'],
            ['label' => 'CSS', 'color' => 'success'],
            ['label' => 'JS', 'color' => 'danger'],
            ['label' => 'Bootstrap', 'color' => 'warning'],
            ['label' => 'Vue', 'color' => 'info'],
            ['label' => 'PHP', 'color' => 'light'],
            ['label' => 'SQL', 'color' => 'warning'],
            ['label' => 'Laravel', 'color' => 'danger'],
        ];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();

            $new_technology->label = $technology['label'];
            $new_technology->color = $technology['color'];

            $new_technology->save();
        }
    }
}
