  <a class="btn btn-s btn-primary" href="{{ route("admin.categories.show",$value->id) }}"> <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="view"></span></a>
  <a class="btn btn-s btn-primary" href="{{ route("admin.categories.edit",$value->id) }}"> <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="edit"></span></a>
  {!!Form::open(['method'=> "DELETE","route" => ["admin.categories.destroy" , $value->id],"style"=>"display:inline"]) !!}
    <a class="btn btn-s btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
       <span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="delete"></span</a>
  {!! Form::close() !!}
