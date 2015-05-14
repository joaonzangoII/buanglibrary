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
        <div class="col-md-6 col-md-offset-2">
          <!-- ''  =>"required",
          'lname'  =>"required",
          'address'  =>"required",
          'email'  =>"required",
          'password'  =>"required",
          'phone'  =>"required", -->
           {!! Form::open(array('method'=>"POST",'action' => 'AdminUsersController@store', 'class' => 'form', 'files'=>true)) !!}
          <div class="row">
            <div class="form-group">
              {!! Form::label('fname', 'Firstname:') !!}
              {!! Form::text('fname', Input::old('fname'), array('class' => 'form-control', 'placeholder' => 'firstname')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('lname', 'Lastname:') !!}
              {!! Form::text('lname', Input::old('lname'), array('class' => 'form-control', 'placeholder' => 'lastname')) !!}
            </div>
            <div class="form-group">
              {!! Form::hidden('fullname', '') !!}
            </div>
            <div class="form-group">
              {!! Form::label('address', 'Adress:') !!}
              {!! Form::text('address', Input::old('address'), array('class' => 'form-control', 'placeholder' => 'address')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email:') !!}
              {!! Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'email')) !!}
            </div>
            {!!Form::hidden("user_type","user")!!}
            {{-- <div class="form-group">
              {!! Form::label('user_type', 'Type') !!}
              {!! Form::select('user_type', $emp_keys,null, array('class' => 'form-control', 'placeholder' => 'types')) !!}
            </div> --}}
            <div class="form-group">
              {!! Form::label('phone', 'Phonenumber:') !!}
              {!! Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'placeholder' => 'Phonenumber')) !!}
            </div>
             <div class="form-group">
               <label for="exampleInputPassword1">Password</label>
               <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
             </div>
            </div>
            <div class="row">
              <div id="success"> </div>
              {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
              <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" ><i class="fa fa-undo"></i> Cancelar</a>
            </div>
          {{-- </div> --}}
        {!! Form::close() !!}
      </div>
  </div>
  @endsection
  @section("scripts")
    @include("admin.partials._select2")
  @endsection
