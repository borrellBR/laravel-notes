<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        "header",
        'text',
        'pinned',
        'reminder',
        'user_id',
    ];

    public static function validateNote(): array
    {
        return [
            'header'     => 'required|string|max:50',
            'text'       => 'required|string',
            'reminder' => 'nullable|date'
        ];
    }


    public static function updateNote(): array
    {
        return [
            'header' => 'required|string|max:255',
            'text'   => 'required|string',
            'reminder' => 'nullable|date'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
{
    return $this->hasMany(Image::class);
}
}
