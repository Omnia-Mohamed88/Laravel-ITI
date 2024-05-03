@extends('layout.app')

@section('content')

    <h1 style="background-color: white;"> All posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-dark">Create new post</a>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Slug</td>
            <td>Content</td>
            <td>By</td>
            <td>Created At</td>
            <td>Show</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->user->name}}</td>
                <td>{{$post->getCreatedAt()}}</td>               
                 <td>
                    <x-button type="primary">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-white text-decoration-none">View</a>
                    </x-button>
                </td>
                <td>
                    <x-button type="secondary">
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-white text-decoration-none">Edit</a>
                    </x-button>
                </td>
                <td>
                    @if($post->trashed())
                        <form method="post" action="{{ route('posts.restore', $post->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                    @else
                        <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{ $posts->links() }}

@endsection
