@extends('layouts.app')

@section('content')


    @foreach($user_u as $usuario)
    <div class ="row justify-content-center">
        <h2>Actualizar cuenta</h2>
    </div>
    <div class="row justify-content-center">
        <form action="{{url('/usuarios',$usuario)}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row align-items-center h-100">
                        <div class="card-body">
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{$usuario->name}}" aria-label="Recipient's username" aria-describedby="basic-addon2"> <br>
                        <input type="text" id="email" name="email" class="form-control" placeholder="{{$usuario->email}}" aria-label="Recipient's username" aria-describedby="basic-addon2"><br>
                        <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="pass" ><br>
                        <input class="btn btn-primary" type="submit"  value="editar"  name="editar" id="editar" dir="editar">
                        <a href="{{url('/usuarios/eliminar',$usuario)}}" class="btn btn-primary">eliminar</a>
                </div>
        </form>
    </div>
    
    @endforeach
    
    
</div>
@endsection