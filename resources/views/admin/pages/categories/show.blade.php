<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>Category</b></h1>
    <div class="col-md-4">
     <p>Name: {{ $book_category->name }}</p>
     <p> Books count: {{ count($book_category->books)}}</p>
     <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Back</a></p>
   </div>
   <div class="col-md-8">
    {{-- <img class="img-responsive img-thumbnail" src="/{{ $musica->image->src }}" alt="{{ $musica->alt }}"> --}}
   </div>
  </div>
@endsection