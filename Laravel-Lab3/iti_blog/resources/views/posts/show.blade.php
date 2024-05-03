@extends("layout.app")

@section("content")
<div class="row"> 
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
        <div class="col m-5"> 
                 <form action="{{route('comments.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="content" placeholder="add content here..." class="form-control w-100 m-5"></textarea>
                        <button type="submit" class="btn btn-primary mx-5">Submit</button>
                  </form>

                <div class="mt-4">
                <h2>Comments</h2>
                @if ($post->comments->count() > 0)
                    <ul class="list-group">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item">{{ $comment->content }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No comments available.</p>
                @endif
                </div>
            </div>
</div>
@endsection


