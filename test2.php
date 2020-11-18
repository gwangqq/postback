<!DOCTYPE html>
<html>
<head>
	<title>POST test</title>
</head>
<body>
[POST] postback data from adbrix server



	</br></br></br>

      <?php
			// Only allow POST requests
	if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
	  throw new Exception('Only POST requests are allowed');
	}

	// Make sure Content-Type is application/json
	$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
	if (stripos($content_type, 'application/json') === false) {
	  throw new Exception('Content-Type must be application/json');
	}

	// Read the input stream
	$body = file_get_contents("php://input");

	// Decode the JSON object
	$object = json_decode($body);
	//
	// if (!is_array($object)) {
	//   throw new Exception('Failed to decode JSON object');
	// }

	// Display the object
	print_r($object);


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

			$sql = "INSERT INTO testDB2 (click_action_1, click_action_2, click_action_3, click_action_4, click_action_5, adid, idfv, possible, os, model, vendor, resolution, orientation, platform, network, wifi, carrier, language, country, buildid, package_name, event_date_time, deeplink_custom_path, event_name, detail_event_name, replaced_event_name)
			VALUES ('$object->click_action_1', '$object->click_action_2', '$object->click_action_3', '$object->click_action_4', '$object->click_action_5', '$object->adid', '$object->idfv', '$object->possible', '$object->os', '$object->model', '$object->vendor', '$object->resolution', '$object->orientation', '$object->platform', '$object->network', '$object->wifi', '$object->carrier', '$object->language', '$object->country', '$object->buildid', '$object->package_name', '$object->event_date_time', '$object->deeplink_custom_path', '$object->event_name', '$object->detail_event_name', '$object->replaced_event_name')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
				echo "<br><br>click_action_1 : ".$object->click_action_1;
        echo "<br><br>click_action_2 : ".$object->click_action_2;
        echo "<br><br>click_action_3 : ".$object->click_action_3;
        echo "<br><br>click_action_4 : ".$object->click_action_4;
        echo "<br><br>click_action_5 : ".$object->click_action_5;
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}


			$sql2 = "SELECT count(*) FROM testDB2";
			$result = $conn->query($sql2);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    echo " total " .$row["count(*)"]. " successfully saved!!!!!";
			  }
			} else {
			  echo "0 results";
			}

				$conn->close();
			?>
</body>
</html>
