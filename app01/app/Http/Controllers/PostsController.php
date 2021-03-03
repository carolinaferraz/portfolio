<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    // this will require authorization in order to access next functions :)

    public function __construct() {
        $this->middleware('auth');
    }


    // index function that will populate the '/' route on web.php
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //find posts from profiles followed & display in descending order/newest first. 5 at the time. 
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        //see posts/index.blade for pagination links

        return view('posts.index', compact('posts'));
    }



    // p/create route redirects to login window

    public function create() {
        return view('posts.create');
    }

    // keeping empty forms from being posted by validating request
    public function store() {

        $data = request()->validate([
            'caption'=> 'required',
            'image'=> ['required', 'image'],
        ]);


    // controlling where image goes. ->store('foldername', 'path')
        $imagePath = request('image')->store('uploads', 'public');


    // using intervention/image library to resize files
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);


        //after creating post, user will be taken to their profile
        return redirect('/profile/' . auth()->user()->id);


            // for json output. turn on/off as needed
        // dd(request()->all());
    }

    public function show(Post $post) {
        // dd($post);

        return view ('posts.show', compact('post'));
    }
}
