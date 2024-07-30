<?php

use App\Models\Post;
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
        Schema::create('post_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->index('user_id', 'idx_user_id');
            $table->index('post_id', 'idx_post_id');
            $table->index(['user_id', 'post_id'], 'idx_user_post');
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
