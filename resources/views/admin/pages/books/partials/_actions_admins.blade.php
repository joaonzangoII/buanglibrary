  <a class="btn btn-s btn-dangerr" href="{{ route("admin.books.show",$value->slug) }}"><i class="fa fa-eye text-info" data-toggle="tooltip" data-placement="top" title="visualizar"></i></a>
  <a class="btn btn-s btn-dangerr" href="{{ route("admin.books.edit",$value->slug) }}"><i class="fa fa-edit text-warning" data-toggle="tooltip" data-placement="top" title="edit"></i></a>
  <!-- {!! Form::open(['route' => ['admin.books.destroy', $value->slug], 'class' => 'inline']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  <a data-original-title="deletar" href="{{ route('admin.books.destroy', $value->slug) }}" data-toggle="tooltip" title="deletar" class="tooltips"><i class="fa fa-trash-o"></i></a>
  {!! Form::close() !!} -->

  {!!Form::open(['method'=> "DELETE","route" => ["admin.books.destroy" , $value->slug],"style"=>"display:inline"]) !!}
    <a class="btn btn-s btn-dangerr" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
      <i class="fa fa-trash-o text-danger"></i></a>
  {!! Form::close() !!}
