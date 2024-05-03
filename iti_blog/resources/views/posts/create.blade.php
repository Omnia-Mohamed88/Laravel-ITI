@extends('layout.app')
@section('content')
    <h1>Create new post</h1>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <input type="text" name="body" class="form-control">
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Author</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save post</button>
    </form>
@endsection
