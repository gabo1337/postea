@extends('layouts.app')

@section('content')


    @foreach($posts as $post)
    
    
    <div class="row align-items-center h-100">
        <div class="card col-md-8 mx-auto">
                <div class="card-body">
                <h5 class="card-title">
                <a href="{{ url('/posts/' . $post->id) }}">
                {{$post->title}}
                
                </a>
                </h5>
                
                @auth
                @if ($post->user_id == auth()->user()->id )
                <form action="{{url('/eliminar',$post)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-dark">eliminar</button>
                <form action=""></form>
                @endif
                @endauth
                
            </div>
        </div>
    </div>
    
    @endforeach
    
    <div class="row align-items-center h-100">
        <div class=" col-md-8 mx-auto"><br>
        {{$posts->links()}}
        </div>
    </div>



</div>
@endsection