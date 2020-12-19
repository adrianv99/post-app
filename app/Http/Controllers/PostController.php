<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct()
    {
        // just can get access to this controller when user is auth
        $this->middleware(['auth']);
    }

    public function index()
    {
        //$posts = Post::get(); // all 
        $posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(5);

        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required' 
        ]);

        //Post::create([
        //    'user_id' => auth()->user()->id,
        //    'body' =>  $request->body
        //]);

        auth()->user()->posts()->create([
            // lavarel adds the user_id automatic, because the relation in User model
            'body'=> $request->body
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        //  if (!$post->ownedBy(auth()->user())) {
        //     dd('You can not delete a post that you dont owned!!');
        //   }
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
