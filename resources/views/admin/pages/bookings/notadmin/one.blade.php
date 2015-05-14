<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
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
         {!! Form::open(array('method'=>"POST",'action' => 'AdminBookingsController@store_booking', 'class' => 'form')) !!}
            {!! Form::hidden('book_id', $book->id) !!}
          <div class="form-group">
            {!! Form::label('num_booked', 'Number to Book') !!}
            {!! Form::text('num_booked', Input::old('num_booked'), array('class' => 'form-control', 'placeholder' => '# to book')) !!}
          </div>
          <div class="form-group">
              {!! Form::label('start_date', 'From') !!}
              {!! Form::input('datetime','start_date', Date("Y-m-d H:i:s") ,['class'=>'form-control', 'placeholder' => 'Start date']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('end_date', 'To') !!}
              {!! Form::input('datetime','end_date', Date("Y-m-d H:i:s"),['class'=>'form-control', 'placeholder' => 'End date']) !!}
          </div>

          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-info')) !!}
          <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Cancelar</a>
        {!! Form::close() !!}
        </div>
      </div>
  </div>
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection
