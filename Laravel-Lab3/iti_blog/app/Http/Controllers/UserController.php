<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index()
    {
        $users = User::paginate(5);
        return view("users.index", ["users"=>$users]);
    }

    public function show(User $user)
    {
        //
        $posts = Posts::where('user_id', $user->id)->get();

        return view('users.show', ["user" => $user, "posts" => $posts]);

    }

}