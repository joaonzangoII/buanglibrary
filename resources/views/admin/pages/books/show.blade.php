<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <div class="col-md-4">
    <h1><b><span class="glyphicon glyphicon-eye-open"></span> Show Book </b></h1>
    <h1><b>title:</b> {{ $book->title }}</h1>
      <img class="img-responsive img-thumbnail" src="/images/uploads/{{ $book->cover->image }}" alt="{{ $book->alt }}">
    </div>
    <div class="col-md-8">
      <p><b>slug:</b> {{ $book->slug }}</p>
      <p><b>Author :</b> {{ $book->author }}</p>
      <p><b>ISBN:</b> {{ $book->isbn }}</p>
      <p><b>Edition:</b> {{ $book->edition }}</p>
      <p><b>Year published:</b> {{ $book->year }}</p>
      <p><b>Posted by:</b> {{ $book->user->fullname }}</p>
     <p><b>Category: </b> {{$book->book_category->name}}</p>
      {{--      <p><b>Published:</b> {{ $book->published_at->format("Y-m-d") }}</p>
      <p><b>Created:</b> {{ $book->created_at->format("Y-m-d") }}</p> --}}
      <p> {!!\DNS2D::getBarcodeHTML($book->isbn, "QRCODE")!!}</p>
      <hr>
      <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Back</a></p>
      {{-- </div> --}}
      
      {{-- </div> --}}
    </div>
  </div>
@endsection