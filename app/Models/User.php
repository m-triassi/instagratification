<?php

namespace App\Models;

use App\Models\Traits\Initializable;
use App\Models\Traits\Uuidable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Uuidable;
    use Initializable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function followers()
    {
        return $this
            ->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')
            ->withTimestamps();
    }

    public function following()
    {
        return $this
            ->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')
            ->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, "author_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "author_id");
    }

}
