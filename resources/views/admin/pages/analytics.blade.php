<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
  {{--   {{!! Form::open() !!}

    {!! Form::close() !!} --}}
  <table>
   @foreach ($analytics as $value)
    <tr>
      <td>{{ $value  }}  </td>
    </tr> 
   @endforeach
  </table>
  </div>
@stop