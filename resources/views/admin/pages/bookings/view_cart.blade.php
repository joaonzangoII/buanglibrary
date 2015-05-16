<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
  {!!Form::open(['method'=> "POST","route" => "admin.bookings.book.cart","style"=>"display:inline"]) !!}
  {{-- {{ Form::hidden("data", $cart) }} --}}
  <table class="table table-striped">
    <th>ID</th>
    <th>Title</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>User</th>
    @foreach ($cart->items() as $item)
    <tr>      
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->quantity }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ \App\User::find($item->user_id)->fullname }}</td>
    </tr>
    @endforeach
  </table>
  <a class="btn btn-s btn-primary" type="button" data-toggle="modal" data-target="#confirmBooking" data-title="Confirm Booking" data-message="Are you sure you want to confirm this booking?">Submit</a>
  {!! Form::close() !!}
  {!!Form::open(['method'=> "GET","route" => "admin.books.empty.cart","style"=>"display:inline"]) !!}
     <a class="btn btn-s btn-danger" type="button" data-toggle="modal" data-target="#confirmEmptyCart" data-title="Confirm Empty" data-message="Are you sure you want to empty the cart?">Empty Cart</a>
  {!! Form::close() !!}
@include("admin.dialogs.booking_confirm")
@include("admin.dialogs.empty_cart_confirm")
@endsection
