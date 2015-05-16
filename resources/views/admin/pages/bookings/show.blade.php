<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <div class="col-md-4">
    <h1><b><span class="glyphicon glyphicon-eye-open"></span> Show Booking</b></h1>
      <img class="img-responsive img-thumbnail" src="/images/uploads/{{ $booking->book[0]->cover->image }}" alt="{{ $booking->book[0]->alt }}">
    </div>
    <div class="col-md-8">
      <p><b>Booking Number:</b> {{ $booking->booking_number }}</p>
      <p><b>Book Name:</b> {{ $booking->book[0]->title }}</p>
      <p><b>Number Booked: </b>{{$booking->num_booked}}</p>
      <p><b>Amount Due: </b>{{$booking->amount}}</p>
      <p><b>Discount? : </b>{{$booking->has_discount}}</p>
      <p><b>From:  </b>{{$booking->start_date->format('Y-m-d')}}</p>
      <p><b>To: </b>{{$booking->end_date->format('Y-m-d')}}</p>
      <p><b>Status: </b>{{$booking->state}}</p>
      <p><b>Booked By: </b>{{$booking->user[0]->fullname}}</p>
      <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Back</a></p>
      {{--  <p><b>title:</b> {{ $book->title }}</p>
      <p><b>ISBN:</b> {{ $book->isbn }}</p>
      <p><b>Year:</b> {{ $book->year }}</p>
      <p><b>Published:</b> {{ $book->published_at->format("Y-m-d") }}</p>
      <p><b>Created:</b> {{ $book->created_at->format("Y-m-d") }}</p> --}}
   </div>

   </div>
@endsection
