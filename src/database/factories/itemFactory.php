<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\item;
use App\Models\User;
use App\Models\brand;
use App\Models\category;
use App\Models\condition;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = ['洋服_メンズ', '洋服_レディス', '靴_メンズ', '靴_レディス'];
        $randomImage = $images[array_rand($images)];

        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'brands_id' => \App\Models\brand::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence,
            'categories_id' => \App\Models\category::inRandomOrder()->first()->id,
            'conditions_id' => \App\Models\condition::inRandomOrder()->first()->id,
            'value' => $this->faker->randomFloat(2, 500, 100000),
            'image' => 'http://localhost/storage/images/' . $randomImage . '.jpg',
        ];
    }
}
