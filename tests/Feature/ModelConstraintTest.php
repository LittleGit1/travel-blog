<?php

use App\Models\CommentLike;
use \App\Models\Post;
use \App\Models\User;
use \App\Models\PostLike;
use \App\Models\PostComment;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

/**
 * Tests Model database constrains
 */

it('tests that a Users Posts are deleted when the User is deleted ', function () {

    $user = User::factory(1)->has(Post::factory(5))->create()->first();
    $userId = $user->id;

    $user->delete();

    $posts = Post::where('user_id', $userId)->count();

    expect($posts)->toBe(0);
});

it('tests that the likes (PostLikes) a User makes on Posts are removed when the User is deleted', function () {
    $user = User::factory(1)->create()->first();
    $userId = $user->id;

    PostLike::factory(5)->create(['user_id' => $user->id]);

    $user->delete();

    $postLikes = PostLike::where('user_id', $userId)->count();

    expect($postLikes)->toBe(0);

});

it('tests that the likes (CommentLikes) a User makes on a PostComment are removed when the User is deleted.', function () {
    $user = User::factory(1)->create()->first();
    $postComment = PostComment::factory(1)->create()->first();

    CommentLike::factory(1)->create([
        'post_comment_id' => $postComment->id,
        'user_id' => $user->id,
    ]);

    $user->delete();

    $userHasLiked = CommentLike::where([
            ['post_comment_id', $postComment->id],
            ['user_id', $user->id],
        ])->count() > 0;

    expect($userHasLiked)->toBeFalse();
});

it('tests that a Users comments (PostComment) still exist with a NULL User reference when that User has been deleted.', function () {

    $user = User::factory(1)->create()->first();
    $post = Post::factory(1)->create()->first();
    $postComment = PostComment::create([
        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => fake()->text(),
    ]);

    $user->delete();
    $postComment->refresh();

    expect($postComment)->not->toBeNull()->and($postComment->user)->toBeNull();

});

it('tests that a Users replies to comments still exist with a NULL User reference when that User has been deleted.', function () {

    $user = User::factory(1)->create()->first();
    $user2 = User::factory(1)->create()->first();
    $post = Post::factory(1)->create()->first();
    $postComment = PostComment::factory(1)->create([
        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => fake()->text(),
    ])->first();

    $postCommentReply = PostComment::factory(1)->create([
        'post_id' => $post->id,
        'user_id' => $user2->id,
        'parent_id' => $postComment->id,
    ])->first();

    $user2->delete();
    $postCommentReply->refresh();

    expect($postCommentReply)->not->toBeNull()
        ->and($postCommentReply->user)->toBeNull();

});

it('tests that all comment replies are deleted when the parent comment is deleted.', function () {
    $user = User::factory(1)->create()->first();
    $user2 = User::factory(1)->create()->first();
    $post = Post::factory(1)->create()->first();
    $postComment = PostComment::factory(1)->create([
        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => fake()->text(),
    ])->first();

    $postCommentId = $postComment->id;

    PostComment::factory(5)->create([
        'post_id' => $post->id,
        'user_id' => $user2->id,
        'parent_id' => $postCommentId,
    ]);

    $postComment->delete();

    $countReplies = PostComment::where([
        ['post_id', $post->id],
        ['parent_id', $postCommentId]
    ])->count();

    expect($countReplies)->toBe(0);

});

it('tests that all post comments are deleted if a Post is deleted', function () {
    $post = Post::factory(1)->create()->first();
    $postComments = PostComment::factory(5)->create([
        'post_id' => $post->id,
    ]);

    $post->delete();

    $countComments = PostComment::where('post_id', $post->id)->count();

    expect($countComments)->toBe(0);

});

it('tests that all Post likes are deleted if a Post is deleted', function () {
    $post = Post::factory(1)->create()->first();
    $postLikes = PostLike::factory(5)->create([
        'post_id' => $post->id,
    ]);

    $postId = $post->id;

    $post->delete();

    $countLikes = PostLike::where('post_id', $postId)->count();

    expect($countLikes)->toBe(0);

});
