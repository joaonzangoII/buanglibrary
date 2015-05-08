<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <h1><b>User</b></h1>
    <div class="col-md-4">
     <p><b>Fullname:</b> {{ $user->fullname }}</p>
     <p><b>User Type:</b> {{ $user->user_type }}</p>
     <p><b>Permissions:</b></p>
     <ul>
       @foreach ($user->permissions as $permission)
         <li>{{ $permission->name }}</li>
       @endforeach
     </ul>
     {{-- <p><b>permissions:</b> {{ $user->permissions }}</p> --}}
   </div>
   <div class="col-md-8">
    {{-- <img class="img-responsive img-thumbnail" src="/{{ $user->image->src }}" alt="{{ $user->alt }}"> --}}
   </div>
  </div>
@endsection