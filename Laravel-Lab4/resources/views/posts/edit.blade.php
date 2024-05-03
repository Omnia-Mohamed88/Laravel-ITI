@extends('layouts.app')


@section('content')
<h1>Update Post {{$post->title}} </h1>
<img src="{{asset('images/posts/'.$post->image)}}" width="100" height="100">
    <form method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data" >
    @csrf
        @method('put')
        <div class="form-group m-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            @error('title')
                <div class="alert alert-danger ">{{ $message }}</div> 
            @enderror
        </div>
        <div class="form-group m-4">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body">{{ $post->body}}</textarea>
            @error('body')
                <div class="alert alert-danger ">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit"
                class="btn btn-success">
                Save post</button>
                or
                <a href="{{route("posts.index")}}" class="btn btn-primary">Back to All Posts</a>

    </form>

@endsection


 