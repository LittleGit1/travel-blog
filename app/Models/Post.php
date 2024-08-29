<?php

namespace App\Models;

use App\Models\Scopes\PostUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([PostUserScope::class])]
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'featured_image_path'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, table: "post_categories");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function carouselImages(): HasMany
    {
        return $this->hasMany(CarouselImage::class);
    }
}
