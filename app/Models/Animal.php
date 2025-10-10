<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'species',
        'name',
        'age',
        'description',
        'image',
        'cage_id'
    ];

    /**
     * Получить клетку, в которой находится животное
     */
    public function cage()
    {
        return $this->belongsTo(Cage::class);
    }

    /**
     * Получить путь к изображению животного
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-animal.jpg');
    }
}
