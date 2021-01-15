<!DOCTYPE html>
<html lang="en">
<head>
  <title>postback url checker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery.min.js"></script>
 <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
  <script>
    $(document).ready(function(){
      $("#check_btn").click(function() {
        $("#result_url").text('');
        str = $("#typed_url").val();
        // get selected macro type from selectpicker 
        var macro_type = $("#typed_url option:selected").val();
        if(str == ''){
          alert("please put postback url");
        } else {
          var domain = str.split('?');
          // alert(domain[0]);
          $("#domain").text(domain[0]);
          var query_strings = domain[1];
          // alert(query_strings)
          var split_query_string = query_strings.split('&');
          var len = split_query_string.length;
          for(i = 0; len; i++){
            var macro = split_query_string[i].split('=');
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
          }
          
          
          
        }
      });
    });
  </script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Adbrix Postback Url Tester</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <!-- select box for option -->
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <div>
        <label for="postback_type">postback type</label>
        <select class = "selectpicker" id = "postback_type">
            <option value="attribution">Attribution</option>
            <option value="event">Event</option>
        </select>
      </div>
    </div>
    <div class="col-sm-2"></div>

    <!-- input url -->
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="input-group mb-3">
            <input id = "typed_url" type="text" class="form-control" placeholder="postback url">
            <div class="input-group-append">
              <button id = "check_btn" class="btn btn-success">check</button>
            </div>
          </div>
    </div>
    <div class="col-sm-2"></div>

    <!-- show domain -->
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <label for="comment" id = "domain">domain</label>
    </div>
    <div class="col-sm-2"></div>

    <!-- result textarea -->
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <label for="comment">result:</label>
      <textarea class="form-control" id = "result_url" rows="7" id="comment" name="result"></textarea>
    </div>
    <div class="col-sm-2"></div>

    <!-- two buttons
        1: url change, 2: show macro-->
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <button type="button" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-secondary">macro list</button>
        </div>
        <div class="col-sm-2"></div>
    
    <!-- result textarea of changed url -->
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <textarea class="form-control" rows="7" id="comment" name="text" readonly></textarea>
        </div>
        <div class="col-sm-2"></div>

    </div>
</div>


</body>
</html>