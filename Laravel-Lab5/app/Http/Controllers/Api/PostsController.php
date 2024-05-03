<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts], 200);
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return response()->json(['post' => $post], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|unique:posts',
            'body' => 'required|min:10',
            'posted_by' => 'required',
            'image' => 'required|image:jpeg,png,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $this->handleFileUpload($request);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $imagePath;
        $post->posted_by = $request->posted_by;
        $post->save();

        return response()->json(['post' => $post], 201);
    }

    public function update(string $id)
    {
        $post = Post::findOrFail($id);
        $validator = Validator::make(request()->all(), [
            'title' => Rule::unique('posts')->ignore($post),
            'body' => 'required|min:10',
            'posted_by' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $filePath = $this->handleFileUpload(request());
        $requestData = request()->all();

        if ($filePath != null) {
            $requestData['image'] = $filePath;
        }

        $post->update($requestData);
        return response()->json(['message' => 'Post updated '], 200);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted '], 200);
    }

    private function handleFileUpload($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $fileName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            
            $filePath = $image->storeAs("images/posts/images", $fileName);
            
            return $filePath;
        }
        return null;
    }
    
}
