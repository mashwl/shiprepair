<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $fillable = [
        'title','short_description','description','icon_class','status'
    ];

    protected static function booted()
    {
        static::deleted(function ($service) {
            // Xóa tất cả các media liên quan khi Service bị xóa
            $service->media->each->delete();
        });
    }
}
