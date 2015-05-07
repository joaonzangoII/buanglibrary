<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>User</b></h1>
    <div class="col-md-4">
     <p><b>Fullname:</b> {{ $user->fullname }}</p>
     <p><b>Type:</b> {{ $user->user_type }}</p>
     <p><b>Roles:</b></p>
     <ul>
       @foreach ($user->roles as $role)
         <li>{{ $role->name }}</li>
       @endforeach
     </ul>
     {{-- <p><b>Roles:</b> {{ $user->roles }}</p> --}}
   </div>
   <div class="col-md-8">
    {{-- <img class="img-responsive img-thumbnail" src="/{{ $user->image->src }}" alt="{{ $user->alt }}"> --}}
   </div>
  </div>
@endsection