<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','status','content','category_id','user_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article','article_id','tag_id');
    }

}
