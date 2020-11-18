<!DOCTYPE html>
<html>
<head>
	<title>get test</title>
</head>
<body>
  <?php
	$servername = "localhost";
	$username = "jakeworks";
	$password = "qkrrhkdrb1!";
	$dbname = "jakeworks";

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT count(*) FROM testDB2";
	$result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "postback count : " .$row["count(*)"];
    }
  } else {
    echo "0 results";
  }

  $conn->close();
   ?>




</body>
</html>
