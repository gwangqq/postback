<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$servername = "localhost";
$username = "jakeworks";
$password = "qkrrhkdrb1!";
$dbname = "jakeworks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT * FROM testDB ORDER BY event_date_time DESC");
$stmt->bind_param("s", $obj->limit);

$sql = "SELECT * FROM testDB ORDER BY event_date_time DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["adid"]. "</td><td>" . $row["idfv"]. "</td><td>" . $row["model"].
    "</td><td>". $row["language"]."</td><td>". $row["detail_event_name"]."</td><td>".$row["event_date_time"]."</td>";
    echo "</tr>";
  }
} else {
  echo "0 results";
}
$conn->close();


// header("Content-Type: application/json; charset=UTF-8");
// $obj = json_decode($_GET["x"], false);

// $conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$stmt = $conn->prepare("SELECT name FROM customers LIMIT ?");
$stmt->bind_param("s", $obj->limit);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);

 ?>
