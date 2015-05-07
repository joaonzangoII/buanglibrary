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
         {!! Form::open(array('method'=>"POST",'action' => 'AdminBooksController@postBooking', 'class' => 'form', 'files'=>true)) !!}
          <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'name')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('num_booked', 'Number to Book') !!}
            {!! Form::text('num_booked', Input::old('num_booked'), array('class' => 'form-control', 'placeholder' => 'name')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'name')) !!}
          </div>

          <div class="form-group">
              {!! Form::label('start_date', 'From') !!}
              {!! Form::input('date','start_date', Date("Y-m-d"),['class'=>'form-control', 'placeholder' => 'Start date']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('end_date', 'To') !!}
              {!! Form::input('date','end_date', Date("Y-m-d"),['class'=>'form-control', 'placeholder' => 'End date']) !!}
          </div>

{{-- * id : int(10) unsigned
* booker_id : int(11)
* book_id : int(11)
* num_booked : int(11)
* amount : decimal(8,2)
* start_date : timestamp
* end_date : timestamp
* created_at : timestamp
* updated_at : timestamp --}}


          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-info')) !!}
        {!! Form::close() !!}
        </div>
      </div>
  </div>
  {{-- SELECT `id`, `titulo`, `link`, `cantor`, `foto`, `descricao`, `categoria_id`, `created_at`, `updated_at` FROM `musicas` WHERE 1 --}}
  <!-- /#page-content-wrapper -->
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection
