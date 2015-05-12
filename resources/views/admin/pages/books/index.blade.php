<!-- Page Content -->
@extends("admin.layouts.master")
  @section("content")
  <div class="container-fluid">
    @if(count($books)>0)
     {{-- {{ dd("here") }} --}}
      <div class="row">
        <div class="col-md-12">
          {{ Auth::User()->user_type }}
          <h1>Available Books</h1>
          <hr>
          <table class="table table-condensed table-striped">
            <tr>
              <th>Cover</th>
              <th>Title</th>
              <th>Author</th>
              <th>Edition</th>
              <th>ISBN</th>
              <th>Total # books</th>
              <th>Avail Books</th>
              <th>Year</th>
              <th>Price Per Book</th>
              <th>Added by</th>
              <th>Book Category</th>
              <th>Actions</th>
            </tr>
            @include("admin.pages.books.partials._books_list")
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
     @include("admin.dialogs.delete_confirm",["value"=> "book"])
  </div>
    @section("scripts")
      @include("admin.partials._script")
    @endsection
  @endsection
