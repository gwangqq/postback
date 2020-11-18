<!DOCTYPE html>
<html>
<head>
	<title>get test</title>
</head>
<body>
	[GET] data from adbrix postback url parameter!!!
	</br></br></br>
			<?php
			$servername = "localhost";
			$username = "jakeworks";
			$password = "qkrrhkdrb1!";
			$dbname = "jakeworks";


			$click_action_1 = $_GET['click_action_1'];
			$click_action_2 = $_GET['click_action_2'];
			$click_action_3 = $_GET['click_action_3'];
			$click_action_4 = $_GET['click_action_4'];
			$click_action_5=$_GET['click_action_5'];
			$adid = $_GET['adid'];
			$idfv=$_GET['idfv'];
			$possible=$_GET['possible'];
			$os=$_GET['os'];
			$model=$_GET['model'];
			$vendor=$_GET['vendor'];
			$resolution=$_GET['resolution'];
			$orientation=$_GET['orientation'];
			$platform=$_GET['platform'];
			$network=$_GET['network'];
			$wifi=$_GET['wifi'];
			$carrier=$_GET['carrier'];
			$language=$_GET['language'];
			$country=$_GET['country'];
			$buildid=$_GET['buildid'];
			$package_name=$_GET['package_name'];
			$event_date_time=$_GET['event_date_time'];
			$event_name = $_GET['event_name'];
			$deeplink_custom_path = $_GET['deeplink_custom_path'];
			$detail_event_name = $_GET['detail_event_name'];
			$replaced_event_name = $_GET['replaced_event_name'];
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			$sql = "INSERT INTO testDB (click_action_1, click_action_2, click_action_3, click_action_4, click_action_5, adid, idfv, possible, os, model, vendor, resolution, orientation, platform, network, wifi, carrier, language, country, buildid, package_name, event_date_time, deeplink_custom_path, event_name, detail_event_name, replaced_event_name)
			VALUES ('$click_action_1', '$click_action_2', '$click_action_3', '$click_action_4', '$click_action_5', '$adid', '$idfv', '$possible', '$os', '$model', '$vendor', '$resolution', '$orientation', '$platform', '$network', '$wifi', '$carrier', '$language', '$country', '$buildid', '$package_name', '$event_date_time', '$deeplink_custom_path', '$event_name', '$detail_event_name', '$replaced_event_name')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
				echo "click_action1 : ".$click_action_1."  deeplink_custom_path : ".$deeplink_custom_path;
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}




			$sql2 = "SELECT count(*) FROM testDB";
			$result = $conn->query($sql2);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    echo "  click_action_1 count : " .$row["count(*)"]. " get postback data successfully!!!!!";
			  }
			} else {
			  echo "0 results";
			}

				$conn->close();
			?>
</body>
</html>
