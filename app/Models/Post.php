<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['img','title', 'category_id', 'user_id', 'body', 'read_time', 'created_at'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "post_category");
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    
    public function loves(): HasMany
    {
        return $this->hasMany(Love::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}