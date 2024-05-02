<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

   
    public function index()
    {
        $posts = Post::paginate(3);
        return view("index", ["posts" => $posts]);
        $users = User::all();
        return view("index" , ["posts"=>$posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("show", ["post" => $post]);
    }

    function store(Request $request){
        $request->validate([
            'title' => 'required|min: 3|unique:posts',
            'body' => 'required|min:10',
            'image' => 'required',
            'posted_by' => 'required', 
        ]);
        $request_params = request()->all();
        $request_params['image'] = $filepath;
        $post = Post::create($request_params);
        return to_route('post.show', $post->id);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();

        return view('edit', ["post"=>$post, "users"=>$users]);    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = request()->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($post->id),'min:3'],
            'body' => ['required','min:10'],
            'created_by'=>['required']
        ]);;
        $request = request();

        // $post->title = $validatedData['title'];
        // $post->body = $validatedData['body'];
        $update_data = request()->all();
        $post->title = $update_data['title']; 
        $post->body = $update_data['body'];
        $post->created_by = $update_data['posted_by'];
        $post->title_slug = Str ::slug($update_data['title']);
        $post->image = $filepath;

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
    public function restore()
    {
        $posts = Post::onlyTrashed()->get();
        $posts->restore();
        return redirect()->back()->with('success', $restoredCount . ' soft deleted posts');
    }
}
