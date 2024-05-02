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
                        <th>Posted By</th>
                        <th>Created At</th>
                        <td> Slug</td>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td>{{ $post->created_by}} </td>
                        <td>{{ $post->created_at->format('Y/m/d H:i') }}</td>
                        <td>{{ $post->title_slug }}</td>
                        <td>{{ $post->updated_at }}</td>

                        <td>
                            <a href="{{route('posts.show', $post->id)}}"> <i class="fas fa-eye"></i></a>
                            <a href="{{route('posts.edit', $post->id)}}"> <i class="fas fa-edit m-2"></i></a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')" style="border: none; background: none;color:red; padding: 0; cursor: pointer;"> <i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}

        </div>
    </div>
</div>
@endsection
