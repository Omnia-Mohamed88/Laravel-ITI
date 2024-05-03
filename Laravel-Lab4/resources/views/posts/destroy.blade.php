@extends('layouts.app')

@section('body')
@method('delete')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-danger text-white">
                        <h2>Delete Post</h2>
                    </div>
                    <div class="card-body text-center">
                        <p>Are you sure you want to delete this post?</p>
                        <h4>{{ $post['title'] }}</h4>
                        <p>{{ $post['body'] }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-danger mx-2">Yes, Delete</button>
                        <a href="#" class="btn btn-secondary ml-3">No, Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection