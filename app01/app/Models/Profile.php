<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage() {

        $imagePath = ($this->image) ?  ($this->image) : 'profile/new-user-default.png';
        return '/storage/' . $imagePath;
    }
    
    use HasFactory;


    //connects w 'following' method on 'User.php'
    public function followers() {
        return $this->belongsToMany(User::class);
    } //this means 'a profile has many users that can follow it'



    //1st to be created. it means '1 profile per 1 user'. 
    // the naming convention user/User is immportant. it comes from creates_profiles_table where it grabs the user_id
    public function user() {
        return $this->belongsTo(User::class);
    } 
    //User.php has to have a function to talk to this one called 'profile()'
}