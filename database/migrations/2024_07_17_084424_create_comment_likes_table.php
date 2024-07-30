<?php

use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->foreignIdFor(PostComment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->index('user_id', 'idx_user_id');
            $table->index('post_comment_id', 'idx_post_comment_id');
            $table->index(['user_id', 'post_comment_id'], 'idx_user_post_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_likes');
    }
};
