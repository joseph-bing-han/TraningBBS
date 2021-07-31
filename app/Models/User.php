<?php

namespace App\Models;

use Faker\Factory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
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

    protected static function boot()
    {
        parent::boot();
        self::creating(function (User $user) {
            if (empty($user->avatar)) {
                $faker = Factory::create();
                $user->avatar = 'public/avatar/' . $faker->image(storage_path('app/public/avatar'), 400, 400, null,
                        false, true, $user->name);
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->where('is_top', 1)->whereNull('parent_id');
    }

    public function comments()
    {
        return $this->hasMany(Post::class)->where('is_top', 0)->whereNotNull('parent_id');
    }
}
