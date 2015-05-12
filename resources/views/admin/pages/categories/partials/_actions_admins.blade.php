  <a class="btn btn-s btn-dangerr" href="{{ route("admin.categories.show",$value->id) }}"><i class="fa fa-eye text-info" data-toggle="tooltip" data-placement="top" title="view"></i></a>
  <a class="btn btn-s btn-dangerr" href="{{ route("admin.categories.edit",$value->id) }}"><i class="fa fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="edit"></i></a>
  {!!Form::open(['method'=> "DELETE","route" => ["admin.categories.destroy" , $value->id],"style"=>"display:inline"]) !!}
    <a class="btn btn-s btn-dangerr" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
      <i class="fa fa-trash-o text-danger"></i></a>
  {!! Form::close() !!}
