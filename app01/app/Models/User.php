<?php

namespace App\Models;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // prevents error of 'title not found' for new user profile display:
protected static function boot() {
    parent::boot();

    // linking user to show as title by default
    
    static::created(function($user) {
        $user->profile()->create([
            'title' => $user->username,
        ]);

        // emailing new users setup w https://mailtrap.io/
        Mail::to($user->email)->send(new NewUserWelcomeMail());


    });
}



    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    //connects w 'followers' method on 'Profile.php' - a prof can have many followers & a user can follow many profiles
    
    public function following() {
        return $this->belongsToMany(Profile::class);
    }


    // 1st to be created.
    // talks to the 'user()' function on Profile.php 
    public function profile() {
        return $this->hasOne(Profile::class);
    }

}