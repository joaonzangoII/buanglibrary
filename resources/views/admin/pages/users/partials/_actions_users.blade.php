  <a class="btn btn-s btn-primary" href="{{ route("admin.users.show",$value->id) }}"> <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="view"></span></a>
  <a class="btn btn-s btn-primary" href="{{ route("admin.users.edit",$value->id) }}"> <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="edit"></span></i></a>
  <!-- {!! Form::open(['route' => ['admin.users.destroy', $value->id], 'class' => 'inline']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  <a data-original-title="deletar" href="{{ route('admin.users.destroy', $value->id) }}" data-toggle="tooltip" title="deletar" class="tooltips"><i class="fa fa-trash-o"></i></a>
  {!! Form::close() !!} -->
@if(Auth::User()->id != $value->id)
  {!!Form::open(['method'=> "DELETE","route" => ["admin.users.destroy" , $value->id],"style"=>"display:inline"]) !!}
    <a class="btn btn-s btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
       <span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="delete"></span></a>
  {!! Form::close() !!}
@endif