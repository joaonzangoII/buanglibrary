  <a class="btn btn-s text-dangerr" href="{{ route("admin.books.show",$value->slug) }}"><span title="show" data-toggle="tooltip" data-placement="top" class="glyphicon glyphicon-eye-open"> </span></a>
  <a class="btn btn-s text-dangerr" href="{{ route("admin.books.edit",$value->slug) }}"><span title="edit" data-toggle="tooltip" data-placement="top" class="glyphicon glyphicon-edit"> </span></a>
  <!-- {!! Form::open(['route' => ['admin.books.destroy', $value->slug], 'class' => 'inline']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  <a data-original-title="deletar" href="{{ route('admin.books.destroy', $value->slug) }}" data-toggle="tooltip" title="deletar" class="tooltips"><i class="fa fa-trash-o"></i></a>
  {!! Form::close() !!} -->

  {!!Form::open(['method'=> "DELETE","route" => ["admin.books.destroy" , $value->slug],"style"=>"display:inline"]) !!}
    <a class="btn btn-s text-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
      <span class="glyphicon glyphicon-trash" title="delete"> </span> </a>
  {!! Form::close() !!}
