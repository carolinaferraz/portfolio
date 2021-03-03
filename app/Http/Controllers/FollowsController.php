<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{

// this will require authorization in order to access next functions :) --- connected w catch(error) in FollowButton.vue

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(User $user) {

//1st $user is the auth one & 2nd is the userProfile passed in the interation (follow/unfollow)

    return auth()->user()->following()->toggle($user->profile);


    }
}
