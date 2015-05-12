<!-- Page Content -->
@extends("app")
  @section("content")
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading">Register</div>
          <div class="panel-body">
            @if($errors->any())
             <div class="alert alert-danger">
               <a href="#" class="close" data-dismiss="alert">&times</a>
               {!! implode('',$errors->all('<li class="error">:message</li>'))!!}
             </div>
            @endif
             {!! Form::open(array('method'=>"POST",'action' => 'AdminUsersController@store', "role"=>"form", 'class' => 'formm', 'files'=>true)) !!}
            {{-- <div class="row"> --}}
              <div class="form-group">
                {!! Form::label('fname', 'Firstname:', array('class' => 'control-label')) !!}
                {!! Form::text('fname', Input::old('fname'), array('class' => 'form-control', 'placeholder' => 'firstname')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('lname', 'Lastname:', array('class' => 'control-label')) !!}
                {!! Form::text('lname', Input::old('lname'), array('class' => 'form-control', 'placeholder' => 'lastname')) !!}
              </div>
              <div class="form-group">
                {!! Form::hidden('fullname', '', array('class' => 'control-label')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('address', 'Adress:', array('class' => 'control-label')) !!}
                {!! Form::text('address', Input::old('address'), array('class' => 'form-control', 'placeholder' => 'address')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email', 'Email:', array('class' => 'control-label')) !!}
                {!! Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'email')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('user_type', 'Type', array('class' => 'control-label')) !!}
                {!! Form::select('user_type', ["lecturer" => "lecturer","student" => "student"],null, array('class' => 'form-control', 'placeholder' => 'types')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('phone', 'Phonenumber:', array('class' => 'control-label')) !!}
                {!! Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'placeholder' => 'Phonenumber')) !!}
              </div>
              {{--  <div class="form-group">
                {!! Form::label('password', 'Password:') !!} 
                {!! Form::password('password', Input::old('password'), array('class'=> 'form-control')); !!}
              </div> --}}
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <div id="success"> </div>
                {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
             </div>
          {!! Form::close() !!}
      </div>
      </div>
    </div>
  </div>
  </div>
  {{-- SELECT `id`, `titulo`, `link`, `cantor`, `foto`, `descricao`, `categoria_id`, `created_at`, `updated_at` FROM `musicas` WHERE 1 --}}
  <!-- /#page-content-wrapper -->
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection