<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function index(User $user) {
        
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        

        // post count & follow count logic moved from index.blade into the cached variables below. 


        $postCount =  Cache::remember(
            'count.posts.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user){
                return $user->posts->count();
        });


        $followersCount = Cache::remember( 
            'count.followers' . $user->id,
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->profile->followers->count();
        });


        $followingCount = Cache::remember( 
            'count.followers' . $user->id,
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->following->count();
        });

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));

    }



    // edit method -- displaying form

    public function edit(User $user) {

        // added after creating ProfilePolicy.php. it makes it so only logged in users can update profile. this same code will be used to protect the update' function below
        $this->authorize('update', $user->profile);


        return view ('profiles.edit', compact('user'));
    }


    // update method -- PATCH action on db

    public function update(User $user) {

        $this->authorize('update', $user->profile);

        // validation rules for updating posts
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);



        // updating profile image. code reused from PostController.
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        //updated all fields on db

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}