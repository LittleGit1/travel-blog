<?php

namespace Database\Seeders;

use App\Models\CommentLike;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'external_id' => Str::uuid(),
            'name' => 'Bruce',
            'email' => 'bvajones@icloud.com',
            'admin' => true
        ]);

        PostCategory::factory()->create(
            [
                'title'     => "Travel",
                'slug'      => "travel"
            ],
        );

        PostCategory::factory()->create(
            [
                'title'     => "Food",
                'slug'      => "food"
            ],
        );

        PostCategory::factory()->create(
            [
                'title'     => "Hiking",
                'slug'      => "hiking"
            ],
        );

        Post::factory(20)->create();

        //PostComment::factory(500)->create();

        //PostComment::factory(500)->reply()->create();

        //PostComment::factory(500)->deletedUser()->create();

        //PostComment::factory(500)->deletedUser()->reply()->create();

        //CommentLike::factory(500)->create();

        PostLike::factory(500)->create();
    }
}
