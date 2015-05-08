  <a class="btn btn-s btn-dangerr" href="{{ route("admin.users.show",$value->id) }}"><i class="fa fa-eye text-info" data-toggle="tooltip" data-placement="top" title="visualizar"></i></a>
  <a class="btn btn-s btn-dangerr" href="{{ route("admin.users.edit",$value->id) }}"><i class="fa fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="edit"></i></a>
  <!-- {!! Form::open(['route' => ['admin.users.destroy', $value->id], 'class' => 'inline']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  <a data-original-title="deletar" href="{{ route('admin.users.destroy', $value->id) }}" data-toggle="tooltip" title="deletar" class="tooltips"><i class="fa fa-trash-o"></i></a>
  {!! Form::close() !!} -->
@if(Auth::User()->id != $value->id)
  {!!Form::open(['method'=> "DELETE","route" => ["admin.users.destroy" , $value->id],"style"=>"display:inline"]) !!}
    <a class="btn btn-s btn-dangerr" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
      <i class="fa fa-trash-o text-danger"></i></a>
  {!! Form::close() !!}
@endif