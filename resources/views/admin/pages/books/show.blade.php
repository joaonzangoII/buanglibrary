<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>Book</b></h1>
    <div class="col-md-4">
     <p><b>slug:</b> {{ $book->slug }}</p>
     <p><b>title:</b> {{ $book->title }}</p>
     <p><b>ISBN:</b> {{ $book->isbn }}</p>
     <p><b>Year:</b> {{ $book->year }}</p>
     <p><b>Published:</b> {{ $book->published_at->format("Y-m-d") }}</p>
     <p><b>Created:</b> {{ $book->created_at->format("Y-m-d") }}</p>
     <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Back</a></p>
   </div>
   <div class="col-md-8">
    <img class="img-responsive img-thumbnail" src="/images/uploads/{{ $book->cover->image }}" alt="{{ $book->alt }}">
   </div>
  </div>
@endsection