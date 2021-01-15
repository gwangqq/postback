<?php
  $a = $_GET['a'];
  $b = $_GET['b'];
  $c = $_GET['c'];

	$servername = "localhost";
	$username = "pbtester";
	$password = "qkrrhkdrb1!";
  $dbname = "pbtester";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if($c == 'attribution'){
    $sql = "SELECT count(*) FROM attribution_macro WHERE attribution = '$b'";
  } elseif($c == 'event'){
    $sql = "SELECT count(*) FROM event_macro WHERE event = '$b'";
  }
	$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["count(*)"]."|$a=$b";
    }
  } else {
    echo "error happened";
  }

  $conn->close();
   ?>