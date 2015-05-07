<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
<div class="container-fluid">
  @if(count($categories))
   {{-- {{ dd("here") }} --}}
    <div class="row">
      <div class="col-md-12">
      <hr>
      <h1>Available Categories</h1>
        <table class="table table-condensed table-striped">
          <tr>
            <th>Name</th>
            <th>Count</th>
          </tr>
          @foreach($categories as $key => $category)
             <tr>
               <td>{{$category->name}}</td>
               <td>{{count($category->books)}}</td>
              </tr>
            @endforeach
        </table>
      </div>
      @else
      <div class="alert alert-info col-md-4" style="margin-top: 15px">No categories Available</div>
    </div>

    <div class="row">
      <div class="text-center">
        {!!$categories->render()!!}
      </div>
    </div>
   @endif
   @include("admin.dialogs.delete_confirm")
</div>
@endsection
