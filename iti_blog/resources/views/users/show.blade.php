@extends("layout.app")

@section("content")

<div class="col">
    <div class="row">
        <h5>{{$user->name}}</h5>
        <p class="card-text">email:{{$user->email}}</p>
    </div>
    <div class="row"> 
        @if ($posts)
        @foreach ($posts as $post)
        <div class="col card m-5" style="width: 18rem;">
            <img height="300"
                src="{{asset('images/posts/'.$post->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">Author:{{$post->user->name}}</p>
                <p class="card-text">Created_at:{{$post->getCreatedAt()}}</p>
                <p class="card-text">Content:{{$post->body}}</p>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back to all posts </a>
            </div>
        </div>
        @endforeach
        @else
            <p>No comments available.</p>
         @endif
        </div>
    </div>
    </div>
@endsection


