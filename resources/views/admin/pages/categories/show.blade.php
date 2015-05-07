<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>Musica</b></h1>
    <div class="col-md-4">
     <p><b>Titulo:</b> {{ $musica->titulo }}</p>
     <p><b>Cantor:</b> {{ $musica->cantor }}</p>
     <p><b>Publicado em:</b> {{ $musica->published_at->format("Y-m-d") }}</p>
     <p><b>Criada em:</b> {{ $musica->created_at->format("Y-m-d") }}</p>
   </div>
   <div class="col-md-8">
    <img class="img-responsive img-thumbnail" src="/{{ $musica->image->src }}" alt="{{ $musica->alt }}">
   </div>
  </div>
@endsection