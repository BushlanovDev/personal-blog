<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ArticleStatusEnum;
use Illuminate\Database\Eloquent\Model;

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
}
