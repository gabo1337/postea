<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class userController extends Controller
{
    public function show()
    {
        $usuarios = User::all();
        $id_user = Auth::id();
        $user_u = User::where('_id','=',$id_user)->get();
        return view('posts.user',compact('user_u'));
    }

    public function editar(User $user, Request $request)
    {
        if($request->name != null ){
            $user->name = $request->name;
            $user->save();
            return redirect('/posts');
        
            
        }
        if($request->email != null){
            $user->email = $request->email;
            $user->save();
            return redirect('/posts');
        }
        if($request->pass != null){
            $contp = $request->get('pass');
            $param_password = password_hash($contp,PASSWORD_DEFAULT);
            $user->password = $param_password;
            $user->save();
            return redirect('/posts');
        }
        else {
            return $request->pass;   
        }
        
    }
    public function eliminar()
    {
        $user_id = auth::id();
        $posts = Post::where('user_id','=',$user_id)->delete();
        $user_u = User::where('_id','=',$user_id)->delete();
        /*
        //esto es para que el usuario elimine solo sus propias creaciones
        $user_id = Auth::id();
        $resultado = Post::find($id);
        $posts = Post::where('user_id','=',$user_id)->where('_id','=',$resultado->id)->delete();
        return redirect('/posts');
        */
        return redirect('/posts');
    }
    
}
