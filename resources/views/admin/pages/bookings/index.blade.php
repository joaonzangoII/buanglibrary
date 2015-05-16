<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
  <div class="container-fluid">
   @if(count($bookings)>0)
    <div class="row">
      <div class="col-md-12">
        <h1>Available Bookings</h1>
       <hr>
        {!! Form::open(array("url" =>"/admin/bookings/?search=1", "method" =>"GET","role" =>"form","class"=>"form-inline")) !!}
        {{-- <form method="GET" action="http://localhost:8000/rapyd-demo/filter?search=1" accept-charset="UTF-8" class="form-inline" role="form"> --}}
          <div class="form-group">
          {!! Form::text('booking_number', Input::old('booking_number'), array('class' => 'form-control', 'placeholder' => 'Booking Number')) !!}
          </div>
          <div class="form-group">
          {!! Form::text('amount', Input::old('amount'), array('class' => 'form-control', 'placeholder' => 'Amount')) !!}
          </div>
          <div class="form-group">
          {!! Form::text('state', Input::old('state'), array('class' => 'form-control', 'placeholder' => 'Status')) !!}
          </div>
          <input class="btn btn-primary" type="submit" value="search">
          <a href="/admin/bookings" class="btn btn-default">Cancel</a>
          <input name="search" type="hidden" value="1">
        {!! Form::close() !!}
        <br> 
       @if (Auth::user()->isAdmin())
        <div class="pull-right">
          <a href="/admin/bookings/create" class="btn btn-default"><span class="glyphicon glyphicon-plus"> </span> New book</a>
        </div>
        <br/>
        <br/>
        <br/>
        @endif
        <div class="table-responsive">
          {{-- <table class="table table-condensed table-striped"> --}}
          <table class="table table-striped">
            <tr>
              <th>Booking Number</th>
              <th>Title</th>
              {{-- <th>Cover</th> --}}
              <th>Quantity</th>
              <th>Amount</th>
              <th>Discount?</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Booker</th>
              <th>Actions</th>
            </tr>
            @foreach($bookings as $key => $value)
               <tr>
                 {{-- 
                 @if ($value->book[0]->cover)
                   <td><img class="img-responsive img-thumbnail" src="{{ Croppa::url('/images/uploads/' . $value->book[0]->cover->image, 300, 200)}}" width="100" height="100" alt=""></td>
                 @else
                   <td><img src="" alt=""></td>
                 @endif
                  --}}
                 <td>{{$value->booking_number}}</td>
                 <td>{{$value->book[0]->title}}</td>
                 <td>{{$value->num_booked}}</td>
                 <td>{{$value->amount}}</td>
                 <td>{{$value->has_discount}}</td>
                 <td>{{$value->start_date->format('Y-m-d')}}</td>
                 <td>{{$value->end_date->format('Y-m-d')}}</td>
                 <td>{{$value->state}}</td>
                 <td>{{$value->user[0]->fullname}}</td>
                 @if(Auth::User()->isAdmin())
                   <td class="center">
                     @include("admin.pages.bookings.partials._actions_admins")
                   </td>
                 @else
                   <td class="center">
                     @include("admin.pages.bookings.partials._actions_normal")
                   </td>
                 @endif
                </tr>
              @endforeach
          </table>
        </div>
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
