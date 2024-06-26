<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');

        $title = fake()->text(20);
        $slug = Str::slug($title);

        $img = fake()->image(null, 250, 250);
        $img_url = Storage::putFileAs('project_images', $img, "$slug.png");

        $category_ids = Category::pluck('id')->toArray();
        $category_ids[] = null;

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => Arr::random($category_ids),
            'content' => fake()->paragraphs(15, true),
            'image' => $img_url,
            'is_published' => fake()->boolean()
        ];
    }
}
