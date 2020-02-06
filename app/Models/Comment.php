<?php

namespace App\Models;

class Comment extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comments', 'likes',
    ];

}
