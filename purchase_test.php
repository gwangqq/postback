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

            // test to get purchase data using get method
			$param_json = $_GET['param_json'];
            $quantity = $_GET['quantity'];
            $category = $_GET['category'];
            $order_id = $_GET['order_id'];
            $price = $_GET['price'];
            $sales = $_GET['sales'];
			$product_name = $_GET['product_name'];
			$date_time = $_GET['date_time'];

            // Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			$sql = "INSERT INTO purchase_test (param_json, quantity, category, order_id, price, sales, product_name, date_time)
			VALUES ('$param_json', '$quantity', '$category', '$order_id', '$price', '$sales', '$product_name', '$date_time')";

			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}




			$sql2 = "SELECT count(*) FROM purchase_test";
			$result = $conn->query($sql2);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			    echo "  postback resulsts : " .$row["count(*)"]. " get postback data successfully!!!!!";
			  }
			} else {
			  echo "0 results";
			}

				$conn->close();
			?>
</body>
</html>