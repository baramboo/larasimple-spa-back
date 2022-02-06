<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();

        return [
            'author_id' => $user->id,
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->paragraph(5, true),
//            'created_at' => $this->faker->dateTimeThisCentury($max = Carbon::now(), $timezone = null),
//            'created_at' => Carbon::now(),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = 'Europe/Kiev')
        ];
    }
}
