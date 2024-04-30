<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createUsers()
    {
        User::factory()->count(10)->create();
    }

    public function create()
    {
        $users = User::all();
        return view("create", ["users" => $users]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'required|image',
            'created_by' => 'required', 
        ]);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->image = $request->file('image')->store('images');

        $postedBy = $request->input('created_by');
        
        $user = User::where('name', $postedBy)->first();

        if ($user) {
            $post->posted_by = $user->name;
        } else {
            $post->posted_by = 'Unknown User';
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function index()
    {
        $posts = Post::paginate(3);
        return view("index", ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("show", ["post" => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view("edit", ["post" => $post]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'sometimes|image',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
            $post->image = $request->file('image')->store('images');

          
        }

      
        

        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
