@extends('layouts.app')

@section('content')

        <!-- dashboard view -->

<div class="container">
    <div class="row">
        <div class="col-3 p-5">
    
        <!-- user profile image  -->
        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>

        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
            <div class="d-flex align-items-center pb-3">
                <div class="h4">{{ $user->username }}</div>


                      <!-- vue component  -->
                      <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
            </div>



        <!-- submit posts -->

        <!-- link only shows up if user is logged in w/ blade directive ❤ -->
        
        @can('update', $user->profile)
            <a href="/p/create">add new post</a>
        @endcan
        </div>


        @can('update', $user->profile)
        <a href="/profile/{{ $user->id }}/edit">edit profile</a>
        @endcan


            <div class="d-flex">

                <!--  post count  -->
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                

                <!--  follow count  -->
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>



                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>   


            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>  
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>

        </div>
</div>

        <!-- posts section -->

        <div class="row pt-5">
        @foreach($user->posts as $post) 
            <div class="col-4 pb-4">
                
                <a href="/p/{{$post->id}}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
    @endforeach

</div>
</div>
@endsection