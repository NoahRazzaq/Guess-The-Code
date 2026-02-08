<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Snippet extends Model
{
        use HasFactory;

    protected $fillable = [
        'code',
        'language',
        'framework',
        'difficulty',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function getCorrectAnswer(): string
    {
        return $this->framework ?: $this->language;
    }
}