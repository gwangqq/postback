
  <?php
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

  // DB name parameter
  $db = $_GET['a'];

  // pagination parameters



  $sql = "SELECT * FROM $db ORDER BY event_date_time DESC";
  $result = $conn->query($sql);
  // HTML for table
  echo '<tr>
      <th>adid</th>
      <th>idfv</th>
      <th>model</th>
      <th>language</th>
      <th>detail_event_name</th>
      <th>event_date_time</th>
   </tr>
   <tr>';
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<td>" . $row["adid"]. "</td><td>" . $row["idfv"]. "</td><td>" . $row["model"].
			"</td><td>". $row["language"]."</td><td>". $row["detail_event_name"]."</td><td>".$row["event_date_time"]."</td>";
			echo "</tr>";
    }
  } else {
    echo "0 results";
  }


  $conn->close();

   ?>
