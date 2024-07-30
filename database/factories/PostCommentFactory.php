<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostComment>
 */
class PostCommentFactory extends Factory
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
            'user_id' => $randomUser->id,
            'post_id' => $randomPost->id,
            'body' => fake()->text(200),
        ];
    }

    public function reply(): static
    {
        return $this->state(fn(array $attributes) => [
            'parent_id' => PostComment::inRandomOrder()->first()->id,
        ]);
    }

    public function deletedUser(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => null,
        ]);
    }
}
