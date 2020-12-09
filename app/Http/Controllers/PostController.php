<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    //
    
   

    public function index()
    {
        $posts= Post::latest()->with(['user', 'likes'])->paginate(20);
        return view('posts.index',['posts'=>$posts]);
    }
 
    public function store(Request $request)
    {
        // return $request->user();
        $this->validate($request,[
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            'body'=> request('body')
        ]);

        return back();
    }

    public function destroy(Post $post,Request $request){
    //   dd($post);
        $this->authorize('delete',$post);
        $post->delete();
        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
