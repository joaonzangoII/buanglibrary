  <a class="btn btn-s btn-dangerr" href="{{ route("admin.books.show",$value->slug) }}"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="show"></span></a>
  <a class="btn btn-s btn-dangerr" href="{{ route("admin.bookings.one",$value->slug) }}"><span class="glyphicon glyphicon-book
glyphicon " data-toggle="tooltip" data-placement="top" title="book"></span></a>
  <a class="btn btn-s btn-dangerr" href="{{ route("admin.books.add.cart", $value->slug) }}"><span class="glyphicon glyphicon-plus
glyphicon " data-toggle="tooltip" data-placement="top" title="add to cart"></span></a>