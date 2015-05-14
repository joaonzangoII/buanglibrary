<!--This is a blade template that goes in email message to site administrator-->
<?php
//get the first name
$name = Input::get('name');
$email = Input::get ('email');
$message = Input::get ('message');
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
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">  <!-- Latest compiled and minified CSS -->
</head>

<body style="margin: 0; padding: 0;">
 <form>
   <h1>Fomos contactados por {{$name}}</h1>
   <p><b>Email:</b> {{$email}}</p>
   <p><b>Data:</b> {{$date_time}}</p>
   <p><b>IP Address:</b> {{$userIpAddress}}</p>
   <br/>
   <p>{{$message}}</p>
 </form>


 <!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>