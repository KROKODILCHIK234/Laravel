<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    // Разрешаем массово заполнять только это поле
    protected $fillable = ['name'];

    // Описываем связь: у одного автора может быть много постов
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
