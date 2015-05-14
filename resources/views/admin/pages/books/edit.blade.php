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
{{--        {!! $edit !!} --}}
        <div class="col-md-6 col-md-offset-3">
         {!! Form::model($book, array('method'=>"PATCH",'route' => ['admin.books.update',$book->slug], 'class' => 'form', 'files'=>true)) !!}
          <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'title')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('author', 'Author') !!}
            {!! Form::text('author', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'author')) !!}
          </div>
           <div class="form-group">
            {!! Form::label('edition', 'Edition') !!}
            {!! Form::text('edition', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'edition')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('isbn', 'ISBN') !!}
            {!! Form::text('isbn', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'isbn')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('total_num_books', 'Total # of books') !!}
            {!! Form::text('total_num_books', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'total # of books')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('year', 'Year Published') !!}
            {!! Form::text('year', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'year published')) !!}
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
              {!! Form::label('published_at', 'Publicado em') !!}
              {!! Form::input('datetime','published_at', $book->published_at->format('Y-m-d H:i:s'),['class'=>'form-control', 'placeholder' => 'published']) !!}
          </div>
          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
          <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Back</a>
         {!! Form::close() !!}
        </div>
      </div>
  </div>
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection
