<?php
			$servername = "localhost";
			$username = "jakeworks";
			$password = "qkrrhkdrb1!";
			$dbname = "jakeworks";


			$is_organic = $_GET['is_organic'];
			$event_date_time = $_GET['event_date_time'];
			$is_attr_owner = $_GET['is_attr_owner_event'];
			$adid = $_GET['adid'];
			$campaign = $_GET['campaign'];
			$attr_owner = $_GET['attr_owner'];
			$attribution_name = $_GET['attribution_name'];
			$in_app_event = $_GET['in_app_event'];


			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			$sql = "INSERT INTO testDB3 (is_organic, event_date_time, is_attr_owner, adid, campaign, attr_owner, attribution_name, in_app_event)
			VALUES ('$is_organic', '$event_date_time', '$is_attr_owner', '$adid', '$campaign', '$attr_owner', '$attribution_name', '$in_app_event')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
				echo "insert query successfully done!!!";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}
				$conn->close();
			?>