<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $post = Post::inRandomOrder()->first();

        return [
            'author_id' => $user->id,
            'post_id' => $post->id,
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
