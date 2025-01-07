<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ArticleStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'status',
        'category_id',
        'title',
        'slug',
        'image_preview',
        'image_detail',
        'text_preview',
        'text_detail',
        'text_detail',
        'published_at',
    ];

    protected $casts = [
        'status' => ArticleStatusEnum::class,
        'category_id' => 'integer',
        'published_at' => 'immutable_date',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
