<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
<div class="container-fluid">
  @if(count($users))
   {{-- {{ dd("here") }} --}}
    <div class="row">
      <div class="col-md-12">
        <h1>Available users</h1>
        <hr>
        <table class="table table-condensed table-striped">
          <tr>
            <th>Name</th>
            <th>email</th>
            <th>Roles</th>
            <th>User Type</th>
          </tr>
          @foreach($users as $key => $employee)
             <tr>
               <td>{{$employee->fullname}}</td>
               <td>{{$employee->email}}</td>
               <td>
                 @foreach ($employee->roles as $role)
                  {{ $role->name }}
                 @endforeach
               </td>
               <td>{{$employee->user_type}}</td>
               <!-- <td>{{$employee->title}}</td> -->
               {{-- <td>
               <img width="50px" src="/{{ $image->image->src }}" alt="" />
             </td> --}}
              </tr>
            @endforeach
        </table>
      </div>
      @else
      <div class="alert alert-info col-md-4" style="margin-top: 15px">No users Available</div>
    </div>

    <div class="row">
      <div class="text-center">
        {!!$users->render()!!}
      </div>
    </div>
   @endif
   @include("admin.dialogs.delete_confirm")
</div>
@endsection
