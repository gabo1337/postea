<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index',['posts' => $posts]);
    }
    public function show($id)
    {
        $resultado = Post::find($id);
        return view('posts.postUnico',['post' => $resultado]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required:max:120',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required:max:2200',
        ]);
        $imageName = $request->file('image')->store(
            'posts/'.Auth::id(),
            'public'
        );
        $title = $request->get('title');
        $content = $request->get('content');

        $post = $request->user()->posts()->create([
            'title' => $title,
            'image' => $imageName,
            'content'=>$content,
        ]);
        return redirect()->route('post', ['id'=>$post->id]);
    }
    
    public function userPosts()
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->paginate(5);
        return view('posts.index',compact('posts'));
        

        
        
    }
    public function today()
    {
        
        $date = Carbon::now()->startOfDay();
        $posts = post::where('created_at','>',$date)->get();
        return view('today', compact('posts'));

    }
    public function eliminar($id)
    {
        /*
        $resultado = Post::find($id);
        $resultado->delete();
        return redirect('/posts');
        */
        
        //esto es para que el usuario elimine solo sus propias creaciones
        $user_id = Auth::id();
        $resultado = Post::find($id);
        $posts = Post::where('user_id','=',$user_id)->where('_id','=',$resultado->id)->delete();
        return redirect('/posts');
        
    }
    
}
   




