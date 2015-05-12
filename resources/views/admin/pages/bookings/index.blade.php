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
            <th>Cover</th>
            <th># Booked</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Booker</th>
            <th>Actions</th>
          </tr>
          @foreach($bookings as $key => $value)
             <tr>
               @if ($value->book[0]->cover)
                 <td><img class="img-responsive img-thumbnail" src="{{ Croppa::url('/images/uploads/' . $value->book[0]->cover->image, 300, 200)}}" width="100" height="100" alt=""></td>
               @else
                 <td><img src="" alt=""></td>
               @endif
               <td>{{$value->book[0]->title}}</td>
               <td>{{$value->num_booked}}</td>
               <td>{{$value->amount}}</td>
               <td>{{$value->start_date}}</td>
               <td>{{$value->end_date}}</td>
               <td>{{$value->user[0]->fullname}}</td>
               @if(Auth::User()->isAdmin())
                 <td class="center">
                   @include("admin.pages.bookings.partials._actions")
                 </td>
               @else
                 <td class="center">
                   @include("admin.pages.bookings.partials._actions")
                 </td>
               @endif
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
  @include("admin.dialogs.delete_confirm",["value"=> "booking"])
  </div>
  @endsection
