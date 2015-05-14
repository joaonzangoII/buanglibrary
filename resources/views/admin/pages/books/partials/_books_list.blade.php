@foreach($books as $key => $value)
  <tr>
     {{--  @if ($value->cover)
        <td>
          <img class="img-responsive img-thumbnail" src="{{ Croppa::url('/images/uploads/' . $value->cover->image, 300, 200)}}" width="100" height="100" alt="">
        </td>
      @else
        <td><img src="" alt=""></td>
      @endif --}}
      <td>{{$value->title}}</td>
      <td>{{$value->author}}</td>
      <td>{{$value->edition}}</td>
      <td>{{$value->isbn}}</td>
      <td>{{$value->total_num_books}}</td>
      <td>{{$value->avail_books}}</td>
      <td>{{$value->year}}</td>
      <td>{{$value->price}}</td>
      <td>{{$value->user->fullname}}</td>
      <td>{{$value->book_category->name}}</td>
      @if(Auth::User()->isAdmin())
        <td class="center">
         @include("admin.pages.books.partials._actions_admins")
        </td>
      @else
        <td class="center">
        @include("admin.pages.books.partials._actions_normal")
      </td>
    @endif
  </tr>
@endforeach