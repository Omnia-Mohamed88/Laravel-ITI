<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;





class PostController extends Controller
{

    function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    protected $fillable = ['title', 'body', 'image', 'user_id', '_token'];


    private function saveImage($request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filepath=$image->store("images","posts_uploads" );
            return $filepath;
        }
        return null;
    }
    
    public function index()
    {
        $posts = Posts::withTrashed()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        //
        $users = User::all();
        return view('posts.create', compact('users'));    

    }

   
    public function store(StorePostsRequest $request)
    {   
        $user_id = Auth::id();
        $request_parms = request();
        $file_path = $this->saveImage($request_parms);
        $req = request()->all();
        $new_post = new Posts();
        $new_post->title = $req['title'] ;
        $new_post->body = $req['body'];
        $new_post->user_id = $user_id;
        $new_post->image = $file_path;

        $new_post->save();

        return to_route('posts.index');  
    }

  
    public function show(Posts $post)
    {
        //
        return view('posts.show', ["post" => $post]);

    }

   
    public function edit(Posts $post)
    {
        return view('posts.edit', ["post" => $post]);
    }


    public function update(UpdatePostsRequest $request, Posts $post)
    {
        Gate::authorize('update', $post);

            $updated_image= $this->saveImage($request);
            $request_data = $request->except('_token');

            if ($updated_image){
                $request_data['image'] = $updated_image;
            }

            $post->update($request_data);
            return to_route('posts.show', $post);
    }


    public function destroy(Posts $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }


    public function restore(int $id)
    {
        $post = Posts::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored successfully.');
    }
    
}
