<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'sub_title' => $this->faker->realText(30),
            'meta_description' => $this->faker->paragraph(3),
            'description' => $this->faker->paragraph,
            'published_date' => $random = Carbon::now()->subDays(rand(0, 365)),
            'display_date' => $random = Carbon::now()->subDays(rand(0, 365)),
            'slug' => $this->faker->slug,
            'author_id' => 1,
        ];
    }
}
