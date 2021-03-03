@extends('layouts.app')

@section('content')



<div class="container">


        <!-- where to post?  https://laravel.com/docs/8.x/controllers#restful-partial-resource-routes informed by route definition table -->
    <form action="/p" enctype="multipart/form-data" method="post">

    <!-- next line is very important for security https://laravel.com/docs/8.x/csrf#csrf-introduction  -->
        @csrf 


    <div class="row">
        <div class="col-8 offset-2">

        <!-- caption creation form, boilerplate from auth/register.blade -->

        <div class="row">
            <h1>Add New Post</h1>
        </div>

        <div class="form-group row">
            <label for="caption" class="col-md-4 col-form-label">Post Caption</label>


                <input id="caption" 
                type="text" 
                class="form-control {{ $errors->has('caption') ? ' is-invalid' : '' }}" 
                name="caption" 
                value="{{ old('caption') }}" autocomplete="caption" autofocus>

                @if ($errors->has('caption'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('caption') }}</strong>
                </span>
                @endif 
                </div>


                <!-- add image -->
                    <div class="row">

                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif 
                    </div>   

                <!-- button -->
                    <div class="row pt-4">
                        <button class="btn btn-primary">add new post</button>
                    </div>                 
        </div>
    </div>    
    </form>
</div>
@endsection
