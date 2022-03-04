<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __constructor(){
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index(){
        $posts = Post::latest()->with(['user', 'likes'])->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'body'=>'required'
        ]);

        $request->user()->posts()->create([
            'body'=>$request->body
        ]);

        return back();
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

//    public function show($post){
//        dd($post);
//        return view('posts.show', compact('post'));
//    }
}
