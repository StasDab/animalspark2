<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'description'
    ];

    /**
     * Получить животных в клетке
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * Получить количество животных в клетке
     */
    public function getAnimalCountAttribute()
    {
        return $this->animals()->count();
    }

    /**
     * Проверить, есть ли свободные места в клетке
     */
    public function hasSpace()
    {
        return $this->animal_count < $this->capacity;
    }

    /**
     * Получить количество свободных мест
     */
    public function getFreeSpaceAttribute()
    {
        return $this->capacity - $this->animal_count;
    }
}
