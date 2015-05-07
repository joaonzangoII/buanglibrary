<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
<div class="container-fluid">
    @include("errors.list")
    <div class="row">
      <div class="col-lg-6">
       {!! Form::model($musica, array('method'=>"PATCH", 'action' => ['AdminArticleController@update', $musica->id], 'class' => 'form', 'files'=>true)) !!}
        <div class="form-group">
          {!! Form::label('titulo', 'Titulo') !!}
          {!! Form::text('titulo', null, array('class' => 'form-control', 'placeholder' => 'Titulo')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('cantor', 'Cantor') !!}
          {!! Form::text('cantor', null, array('class' => 'form-control', 'placeholder' => 'Cantor')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('link', 'Link') !!}
          {!! Form::text('link', null, array('class' => 'form-control', 'placeholder' => 'Link')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('descricao', 'Descrição') !!}
          {!! Form::textarea('descricao', null, array('class' => 'form-control', 'placeholder' => 'Descrição')) !!}
        </div>
      {{--   <div class="form-group">
          <label for="attrLinkDaImagem">Link da Imagem</label>
          <input name ="linkdaimagem" type="text" class="form-control" id="attrLinkDaImagem" placeholder="Link da Imagem">
        </div> --}}
        <div class="form-group">
          {!! Form::label('categoria_id', 'Categoria') !!}
          {!! Form::select('categoria_id',$categorias, null, array('class' => 'form-control')) !!}
        </div>
         <div class="form-group">
            {!! Form::label('published_at', 'Publicado em') !!}
            {!! Form::input('date','published_at', $musica->published_at,['class'=>'form-control', 'placeholder' => 'Image alt...']) !!}
        </div>

          {{-- <div class="control-group">
             <div class="form-group">
                {!! Form::label('alt', 'Image Alt') !!}
                {!! Form::text('img_alt', null  ,array('class'=>'form-control', 'placeholder' => 'Image alt...')) !!}
            </div>
            <div class="controls">
              {!! Form::file('image') !!}
               <p class="help-block">Hey! Please don't upload over 15MB images!</p>
            <p class="errors">{{$errors->first('image')}}</p>
              @if(Session::has('error'))
                <p class="errors">{{ Session::get('error') }}</p>
              @endif
            </div>
          </div> --}}
          <div id="success"> </div>
          {!! Form::submit('Modificar', array('class'=>'btn btn-info')) !!}
        {!! Form::close() !!}
      </div>
    </div>
</div>
{{-- SELECT `id`, `titulo`, `link`, `cantor`, `foto`, `descricao`, `categoria_id`, `created_at`, `updated_at` FROM `musicas` WHERE 1 --}}
<!-- /#page-content-wrapper -->
@endsection
@endsection
@section("scripts")
  @include("admin.partials._select2")
@endsection
