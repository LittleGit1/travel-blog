<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentLike>
 */
class CommentLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPost = PostComment::inRandomOrder()->first();
        $randomUser = User::inRandomOrder()->first();
        return [
            "user_id"   => $randomUser->id,
            "post_comment_id"   => $randomPost->id
        ];
    }
}
