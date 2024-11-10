<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'img', 'placement', 'cta', 'link'];

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function text(): HasOne
    {
        return $this->hasOne(Text::class);
    }
}