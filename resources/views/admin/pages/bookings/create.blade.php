<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
  {{ $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'] }}
  <div class="container-fluid">
      <div class="col-md-12">
       @if($errors->any())
         <div class="alert alert-danger">
           <a href="#" class="close" data-dismiss="alert">&times</a>
           {!! implode('',$errors->all('<li class="error">:message</li>'))!!}
         </div>
       @endif
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h1><b><span class="glyphicon glyphicon-plus"></span> Create Booking </b></h1>
         {!! Form::open(array('method'=>"POST",'action' => 'AdminBookingsController@store', 'class' => 'form')) !!}
          <div class="form-group">
            {!! Form::label('booker_id', 'User') !!}
            {!! Form::select('booker_id', $user_keys,null, array('class' => 'form-control', 'placeholder' => 'Book')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('book_id', 'Book') !!}
            {!! Form::select('book_id', $book_keys,null, array('class' => 'form-control', 'placeholder' => 'Book')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('num_booked', 'Number to Book') !!}
            {!! Form::text('num_booked', Input::old('num_booked'), array('class' => 'form-control', 'placeholder' => '# to book')) !!}
          </div>

          <div class="form-group">
              {!! Form::label('start_date', 'From') !!}
              {!! Form::input('date','start_date', Date("Y-m-d") ,['class'=>'form-control', 'placeholder' => 'Start date']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('end_date', 'To') !!}
              {!! Form::input('date','end_date', Date("Y-m-d"),['class'=>'form-control', 'placeholder' => 'End date']) !!}
          </div>


          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
          <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Cancelar</a>
        {!! Form::close() !!}
        </div>
      </div>
  </div>
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection
