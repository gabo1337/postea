<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\Comentarios;

class CommentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required:max:250',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->content = $request->get('content');

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        //notificacion

        $not = Post::find($request->get('post_id'));
        $id =  $not->user_id;
        $enviar = User::where('_id','=',$id)->get(['name']);
        foreach ($enviar as $enviars) {
            $nombre = $enviars->name;
        }

        
        User::all()
        ->each(function(User $users) use ($comment,$nombre){
            if($users->name == $nombre){
                $usuario_registrado = auth()->user()->name;
            $users->notify(new Comentarios($comment,$usuario_registrado));
        } 
        
    }
    );


        

       return redirect()->route('post',['id'=> $request->get('post_id')]);
    }

    public function notificacion(Request $request)
    {
        
        $user=$request->user();
        $notificacion = $user->unreadNotifications;  

        return view('posts.notificaciones',['notificacion'=>$notificacion]);
        
    }
   
}