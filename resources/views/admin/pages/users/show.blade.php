<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <div class="col-md-4">
     <h1><b><span class="glyphicon glyphicon-eye-open"></span> Show User</b></h1>
     <hr>
     <p><b>Fullname:</b> {{ $user->fullname }}</p>
     <p><b>Phone:</b> {{ $user->phone }}</p>
     <p><b>Email:</b> {{ $user->email }}</p>
     <p><b>ID_Number:</b> {{ $user->id_number }}</p>
     <p><b>DOB:</b> {{  $user->date_of_birth() }}</p>      
     <p><b>Gender:</b> {{  $user->gender() }}</p>      
     <p><b>Address:</b> {{ $user->address }}</p>
     <p><b>User Type:</b> {{ $user->user_type }}</p>
     <p><b>Permissions:</b></p>
     <ul>
       @foreach ($user->permissions as $permission)
         <li>{{ $permission->name }}</li>
       @endforeach
     </ul>
     {{-- <p><b>permissions:</b> {{ $user->permissions }}</p> --}}
     <p><a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Back</a></p>
   </div>
   <div class="col-md-8">
    {{-- <img class="img-responsive img-thumbnail" src="/{{ $user->image->src }}" alt="{{ $user->alt }}"> --}}
   </div>
  </div>
@endsection