<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
  <div class="container-fluid">
   @if(count($bookings)>0)
    <div class="row">
      <div class="col-md-12">
        <h1>Available Bookings</h1>
        <hr>
        <table class="table table-condensed table-striped">
          <tr>
            <th>Book</th>
            <th># Booked</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Booker</th>
          </tr>
          @foreach($bookings as $key => $booking)
             <tr>
               <td>{{$booking->book[0]->fulltitle}}</td>
               <td>{{$booking->num_booked}}</td>
               <td>{{$booking->amount}}</td>
               <td>{{$booking->start_date}}</td>
               <td>{{$booking->end_date}}</td>
               <td>{{$booking->user[0]->fullname}}</td>
              </tr>
            @endforeach
        </table>
      </div>
      @else
      <div class="alert alert-info col-md-4" style="margin-top: 15px">No bookings Available</div>
    </div>

    <div class="row">
      <div class="text-center">
        {!!$bookings->render()!!}
      </div>
    </div>
   @endif
  </div>
  @endsection
