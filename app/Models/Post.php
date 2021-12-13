<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uniq_code',
        'title',
        'image',
        'details',
        'type',
        'slug',
        'user_id',
    ];

    protected $hidden = [
        'id',
        'uniq_code',
        'user_id',
    ];
}
