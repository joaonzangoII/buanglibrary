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
        <div class="col-lg-6">
        <h1><b><span class="glyphicon glyphicon-edit"></span> Edit Book Category</b></h1>
         {!! Form::model($book_category, array('method'=>"PATCH", 'action' => ['AdminCategoriesController@update', $book_category->id], 'class' => 'form', 'files'=>true)) !!} <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', Input::old('titulo'), array('class' => 'form-control', 'placeholder' => 'Name')) !!}
          </div>
          <div id="success"> </div>
          {!! Form::submit('Submit', array('class'=>'btn btn-info')) !!}
          <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Back</a>
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
