<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagArticle extends Model
{
    use HasFactory;
    protected $table = 'tag_article';

    // Xác định các trường có thể được gán hàng loạt
    protected $fillable = [
        'article_id',
        'tag_id',
    ];
}
