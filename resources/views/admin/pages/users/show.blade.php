<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>User</b></h1>
    <div class="col-md-4">
     <p><b>Titulo:</b> {{ $user->titulo }}</p>
     <p><b>Cantor:</b> {{ $user->cantor }}</p>
     <p><b>Publicado em:</b> {{ $user->published_at->format("Y-m-d") }}</p>
     <p><b>Criada em:</b> {{ $user->created_at->format("Y-m-d") }}</p>
   </div>
   <div class="col-md-8">
    <img class="img-responsive img-thumbnail" src="/{{ $user->image->src }}" alt="{{ $user->alt }}">
   </div>
  </div>
@endsection