<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    CONST TECH_CATEGORY = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
    */

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
        'category',
        'tag',
        'date'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];
}
