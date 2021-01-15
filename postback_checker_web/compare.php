<?php
  $a = $_GET['a'];
	$servername = "localhost";
	$username = "pbtester";
	$password = "qkrrhkdrb1!";
  $dbname = "pbtester";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT count(attribution) FROM attribution_macro WHERE attribution = '$a'";
	$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["count(attribution)"];
    }
  } else {
    echo "error happened";
  }

  $conn->close();
   ?>