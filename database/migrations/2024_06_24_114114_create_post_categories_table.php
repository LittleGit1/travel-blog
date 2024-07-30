<?php

use App\Models\Post;
use App\Models\PostCategory;
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
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PostCategory::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('post_category');
    }
};
