<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
  <div class="container-fluid">
    @if(count($books))
     {{-- {{ dd("here") }} --}}
      <div class="row">
        <div class="col-md-12">
          {{ Auth::User()->type }}
          <h1>Available Books</h1>
          <hr>
          <table class="table table-condensed table-striped">
            <tr>
              <th>Cover</th>
              <th>Name</th>
              <th>Title</th>
              <th>Author</th>
              <th>Edition</th>
              <th>ISBN</th>
              <th>Total # books</th>
              <th>Avail Books</th>
              <th>Year</th>
              <th>Price Per Book</th>
              <th>Added by</th>
              <th>Category</th>
              <th>Actions</th>
            </tr>
            @foreach($books as $key => $value)
              <tr>
                  @if ($value->cover)
                    <td><img src="/images/uploads/{{$value->cover->image}}" width="100" alt=""></td>
                  @else
                    <td><img src="" alt=""></td>
                  @endif
                  <td>{{$value->name}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->author}}</td>
                  <td>{{$value->edition}}</td>
                  <td>{{$value->isbn}}</td>
                  <td>{{$value->total_num_books}}</td>
                  <td>{{$value->avail_books}}</td>
                  <td>{{$value->year}}</td>
                  <td>{{$value->price}}</td>
                  <td>{{$value->user->fullname}}</td>
                  <td>{{$value->category->name}}</td>
                  @if(Auth::User()->user_type ==="admin" || Auth::User()->user_type ==="super_admin")
                    <td class="center">
                      @include("admin.partials._actions_admins")
                    </td>
                  @else
                    <td class="center">
                      @include("admin.partials._actions_normal")
                    </td>
                  @endif
                 {{-- <td>
                 <img width="50px" src="/{{ $image->image->src }}" alt="" />
               </td> --}}
                </tr>
              @endforeach
          </table>
        </div>
        @else
        <div class="alert alert-info col-md-4" style="margin-top: 15px">No books Available</div>
      </div>

      <div class="row">
        <div class="text-center">
          {!!$books->render()!!}
        </div>
      </div>
     @endif
     @include("admin.dialogs.delete_confirm")
  </div>
    @section("scripts")
      @include("admin.partials._set_published")
    @endsection
  @endsection
