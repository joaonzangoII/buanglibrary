<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        {{-- {{ Auth::user() }} --}}
        <section class="col-md-99">
        <h1>Profile: {{ Auth::user()->fullname }}</h1>
        <p>email:    {{ Auth::user()->email }}</p>


        <p>All Books:   {{ count($books) }}</p>
        <ul>
          @foreach ($books as $book)
            <li>{{$book->title}}</li>
          @endforeach
        </ul>
        </section>
      </div>
    </div>
</div>

<!-- /#page-content-wrapper -->
@stop
