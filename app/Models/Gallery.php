<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'img'];

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}