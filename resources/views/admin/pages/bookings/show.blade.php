<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>Booking</b></h1>
    <div class="col-md-4">
      <p><b>Book Name:</b> {{ $booking->book[0]->title }}</p>
      <p><b>Number Booked: </b>{{$booking->num_booked}}</td>
      <p><b>Amount Due: </b>{{$booking->amount}}</td>
      <p><b>Discount? : </b>{{$booking->has_discount}}</td>
      <p><b>From:  </b>{{$booking->start_date}}</td>
      <p><b>To: </b>{{$booking->end_date}}</td>
      <p><b>Status: </b>{{$booking->state}}</td>
      <p><b>Booked By: </b>{{$booking->user[0]->fullname}}</td>
      <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Back</a></p>
      {{--  <p><b>title:</b> {{ $book->title }}</p>
      <p><b>ISBN:</b> {{ $book->isbn }}</p>
      <p><b>Year:</b> {{ $book->year }}</p>
      <p><b>Published:</b> {{ $book->published_at->format("Y-m-d") }}</p>
      <p><b>Created:</b> {{ $book->created_at->format("Y-m-d") }}</p> --}}
   </div>
   <div class="col-md-8">
    <img class="img-responsive img-thumbnail" src="/images/uploads/{{ $booking->book[0]->cover->image }}" alt="{{ $booking->book[0]->alt }}">
   </div>
  </div>
@endsection
