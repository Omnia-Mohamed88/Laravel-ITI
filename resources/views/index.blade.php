@extends('layouts.myapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All Posts</h1>
            <div class="mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['body'] }}</td>
                        <td>
                            <a href="{{route('posts.show',$post['id'] )}}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{route('posts.edit',$post['id'] )}}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection