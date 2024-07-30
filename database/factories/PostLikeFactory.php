<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostLike>
 */
class PostLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPost = Post::inRandomOrder()->first();
        $randomUser = User::inRandomOrder()->first();
        return [
            "user_id"   => $randomUser->id,
            "post_id"   => $randomPost->id
        ];
    }
}
