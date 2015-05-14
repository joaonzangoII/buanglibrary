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
        <h1><b><span class="glyphicon glyphicon-plus"></span> Create Book</b></h1>
         {!! Form::open(array('method'=>"POST",'action' => 'AdminBooksController@store', 'class' => 'form', 'files'=>true)) !!}
          <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'title')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('author', 'Author') !!}
            {!! Form::text('author', Input::old('author'), array('class' => 'form-control', 'placeholder' => 'author')) !!}
          </div>
           <div class="form-group">
            {!! Form::label('edition', 'Edition') !!}
            {!! Form::text('edition', Input::old('edition'), array('class' => 'form-control', 'placeholder' => 'edition')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('isbn', 'ISBN') !!}
            {!! Form::text('isbn', Input::old('isbn'), array('class' => 'form-control', 'placeholder' => 'isbn')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('total_num_books', 'Total # of books') !!}
            {!! Form::text('total_num_books', Input::old('total_num_books'), array('class' => 'form-control', 'placeholder' => 'total # of books')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('year', 'Year Published') !!}
            {!! Form::text('year', Input::old('year'), array('class' => 'form-control', 'placeholder' => 'year published')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', Input::old('price'), array('class' => 'form-control', 'placeholder' => 'price')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('book_category_id', 'Book Category') !!}
            {!! Form::select('book_category_id', $category_keys,null, array('class' => 'form-control', 'placeholder' => 'Book Category')) !!}
          </div>
          <div class="form-group">
              {!! Form::label('published_at', 'Available from') !!}
              {!! Form::input('date','published_at', Date("Y-m-d"),['class'=>'form-control', 'placeholder' => 'published']) !!}
          </div>
           <div class="control-group">
       {{--       <div class="form-group">
                {!! Form::label('alt', 'Image Alt') !!}
                {!! Form::text('alt',Input::old('alt'),['class'=>'form-control', 'placeholder' => 'Image alt...']) !!}
            </div> --}}
            <div class="controls">
              {!! Form::file('image') !!}
              <p class="help-block">Hey! Please don't upload over 15MB images!</p>
              <p class="errors">{{$errors->first('image')}}</p>
              @if(Session::has('error'))
                <p class="errors">{{ Session::get('error') }}</p>
              @endif
            </div>
          </div>
          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
          <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Cancelar</a>
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
