<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes; // "Мягкое удаление" уже здесь

    // Разрешаем массово заполнять эти поля
    protected $fillable = ['author_id', 'title', 'content'];

    // Описываем связь: пост принадлежит одному автору
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
