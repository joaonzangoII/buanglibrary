@if(!Auth::User()->isAdmin())
<li><a  href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" role="button" >{{ $cart->count() }} items <span class="glyphicon glyphicon-shopping-cart"></span><b class="caret"></b></a>
<ul class="dropdown-menu" role="menu">
<table class="table table-striped">
<th>ID</th>
<th>Title</th>
<th>Quantity</th>
<th>Price</th>
<th>User</th>
@if($cart->count() > 5)
@foreach($cart->items()->take(5) as $item)
  <tr>      
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->quantity }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ \App\User::find($item->user_id)->fullname }}</td>
  </tr>
@endforeach
@else
@foreach($cart->items() as $item)
  <tr>      
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->quantity }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ \App\User::find($item->user_id)->fullname }}</td>
  </tr>
@endforeach
@endif

</table>
{{-- 		  
@foreach ($cart->items() as $item)
<li><a tabindex="-1" href="#">{{ $item->name }}  - {{ $item->quantity }} </a></li>
@endforeach --}}
<li><a class="text-center" href="{{ route("admin.bookings.cart") }}">View All</a></li>
</ul>
</li>
@endif