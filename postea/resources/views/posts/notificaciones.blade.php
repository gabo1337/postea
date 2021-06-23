@extends('layouts.app')
@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">FECHA</th>
        <th scope="col">MENSAJE</th>
        <th scope="col">DE:</th>
      </tr>
    </thead>
@foreach ($notificacion as $notificaciones)
    <tbody>
      <tr>
        
        <th scope="row">{{$notificaciones->created_at}}</th>
        <td>{{$notificaciones->data['message']}}</td>
        <td>{{$notificaciones->data['user']}}</td>
      </tr>
      @php
          $notificaciones->markAsRead();
      @endphp
  
      @endforeach

      
      
    </tbody>
  </table>
@endsection