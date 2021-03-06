<!--This is a blade template that goes in email message to site administrator-->
<?php
//get the first name
$name = $user->fullname;
$email = $user->email;
$date_time = date("F j, Y, g:i a");
$userIpAddress = Request::getClientIp();
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Buang Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">  <!-- Latest compiled and minified CSS -->
</head>

<body style="margin: 0; padding: 0;">
  <form>
    <h1><b>Your Booking was successful!</b></h1>
    <h3>Booking details</h3>
     {{-- {{ $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'] }} --}}
    <div class="col-md-4">      
     @if ($book->cover)
       <td><img class="img-responsive img-thumbnail" src="{{ $_SERVER['SERVER_NAME'] }}/images/uploads/{{ $book->cover->image}}" width="100" height="100" alt=""></td>
     @else
       <td><img src="" alt=""></td>
     @endif
    </div>
    <div class="col-md-8">     
      <p><b>Booking Number:</b> {{ $booking->booking_number }}</p>
      <p><b>Book Title:</b> {{ $book->title }}</p>
      <p><b>Number booked:</b> {{ $booking->num_booked }}</p>
      <p><b>Amount Due:</b> R{{ number_format($booking->amount,2) }}</p>
      <hr>
      <p>Please come and collect your book(s) within 24 hours</p>
      </div>
  </form>
 <!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>