<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $fillable = [
        'id',
        'post_id',
        'user_id',
        'body',
        'like',
        'dislike',
        'date'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'post_id' => 'string'
    ];
}
