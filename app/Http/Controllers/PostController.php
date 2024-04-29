<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        ['id' => 1, 'title' => 'Study', 'body' => 'No sleep', 'image' => '../../images/blog/brain.jpg'],
    
        ['id' => 2, 'title' => 'exams', 'body' => 'aloot of exams', 'image' => '../../spring.jpg'],
        ['id' => 3, 'title' => 'labs', 'body' => 'tough labs', 'image' => '../../yoou (1).jpg'],
    ];

    function create(){
        return view("create");
    }
    function index()
    {
        return view("index", ["posts" => $this->posts]);
    }
    function show($id){
        if ($id <= count($this->posts)){
            $post = $this->posts[$id-1];
            return view('show' , ["post" => $post]);
        }
        return abort(404);
    }

    function edit($id){
        if($id <= count($this->posts)){
            $post = $this->posts[$id-1];
            return view('edit', ["post" => $post]);
        }
 
        return abort(404);
    }
    public function destroy($id)
    {
        $postIndex = $id - 1;

        if ($postIndex < count($this->posts)) {
            unset($this->posts[$postIndex]);

            $this->posts = array_values($this->posts);
            return view('index', ["posts" => $this->posts]);
        }

        return abort(404);
    }
}
