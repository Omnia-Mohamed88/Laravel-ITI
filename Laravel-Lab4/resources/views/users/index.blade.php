@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All users</h1>
            <div class="mb-3">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                    <x-button type="primary">
                        <a href="{{ route('users.show', $user->id) }}" class="text-white text-decoration-none">View</a>
                    </x-button>
                </td>
                <td>
                    <x-button type="secondary">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-white text-decoration-none">Edit</a>
                    </x-button>
                </td>
                <td>
                        <form method="post" action="{{ route('users.destroy', $user->id) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection