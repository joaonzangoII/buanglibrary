@extends("site.layouts.master")
@section("content")
  <div class="wrapper">
    <div class="container">
    {{ $query }}
    {{ $total }}
    <ul>
      @foreach ($search_values as $value)
        <li>{{ $value->name }}</li>
      @endforeach
    </ul>
    </div>
  </div>
@endsection