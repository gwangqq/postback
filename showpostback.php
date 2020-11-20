<!DOCTYPE html>
<html>

<head>
	<title>jake attribution test postback page</title>
	<script src="//code.jquery.com/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
  function search() {
    var category = $('#selector').val();
    var param = $('#search').val().trim();
    var db_selector = $('#db').val();

    if(param != '' && category != 'category'){
      location.href='<?php echo $_SERVER['PHP_SELF'];?>?a='+db_selector+'&page=1&category=' + category +'&search=' + param;
    } else if (param =='' && category =='category'){
      location.href='<?php echo $_SERVER['PHP_SELF'];?>?a='+db_selector+'&page=1';
    } else if (param != '' && category !='category'){
      alert('please type a word!!!');
    } else {
      alert('check your word one more time!!!');
    }
  }
  
  function enterkey() {
     if (window.event.keyCode == 13) {
      search();
    } 
  }

</script>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h1>adbrix se-team intern assignment</h1><br><br>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h2>results of postback</h2>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
        <div class="input-group-prepend">
          <select class="form-control" id = "db">
            <?php 
              $selected = $_GET['a'];
            ?>
            <option class = "db" id = "testDB" value = "testDB"
              <?php
                if(isset($selected)&& ($selected == 'testDB')){
                  echo 'selected';
                } else {

                }
              ?>
            >GET</option>
            <option class = "db" id = "testDB2" value = "testDB2"
            <?php
                if(isset($selected)&& ($selected == 'testDB2')){
                  echo 'selected';
                } else {
                  
                }
              ?>
            >POST</option>
          </select> 
        </div>
				<!-- <button type="button" id="a" class="btn btn-primary" value="testDB" onclick="location.href='showpostback.php?a=testDB&page=1'">GET</button>
				<button type="button" id="b" class="btn btn-success" value="testDB2" onclick="location.href='showpostback.php?a=testDB2&page=1'">POST</button> -->
			</div>
			<div class="col-md-1"></div>
		</div>
		
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
  if(isset($_GET['a'])){
    $db = $_GET['a'];
  } else {
    $db = 'testDB';
  }

  // pagination parameter
  if (isset($_GET['page'])) {
    // paging parameters
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  // category paramter
  if(isset($_GET['category'])){
    $category = $_GET['category'];
  } else {
    $category = 1;
  }

  // search paramter
  if(isset($_GET['search'])){
    $search = $_GET['search'];
  } else {
    $search = 1;
  }

  // paging code
  if(($search == 1)&&($category == 'category' || $category == 1 )){
    $paging_sql = "SELECT * FROM $db";
  } else {
    $paging_sql = "SELECT * FROM $db where $category = '$search'";
  }
  $result_set = mysqli_query($conn, $paging_sql);
  ?>

<div class = "row">
<div class="col-md-1"></div>
<div class="col-md-10">
  <label id = "results_count" class="text-success">
    <h3>
      <?php
      $total_cnt = (int) mysqli_num_rows($result_set); 
      echo $total_cnt.' results';
      ?>
    </h3>
  </label>
</div>
<div class="col-md-1"></div>
</div>
<div class="row">
  <!-- HTML for table -->
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <table  class="table table-dark table-hover table-striped">
        <tr>
            <th>no</th>
        		<th>adid</th>
        		<th>idfv</th>
        		<th>model</th>
        		<th>country</th>
        		<th>detail_event_name</th>
        		<th>event_date_time</th>
	       </tr>
	       <tr>
  <?php
  $list = 7;
      $block_cnt = 5;
      $block_num = ceil($page / $block_cnt);
      
      $block_start = (ceil(($page / $block_cnt) -1 ) * $block_cnt) + 1;

      $block_end = $block_start + $block_cnt - 1;

      $total_page = ceil($total_cnt / $list);

      if($block_end > $total_page){
        $block_end = $total_page;
      }

      $total_block = ceil($total_page / $block_cnt);
      $page_start = ($page -1) * $list;



  if(($search == 1)&&($category == 'category' || $category == 1 )){    
    //$sql = "SELECT * FROM $db ORDER BY event_date_time DESC LIMIT $page_start, $list";
    $sql = "SELECT * FROM (SELECT @rownum:=@rownum+1 no, s.* FROM $db s, (select @rownum:=0) tmp ORDER by event_date_time) test ORDER BY no DESC LIMIT $page_start, $list";
    
    
  
  } else {
    // $sql = "SELECT * FROM $db where $category = '$search' ORDER BY event_date_time DESC LIMIT $page_start, $list";
    $sql = "SELECT * FROM (SELECT @rownum:=@rownum+1 no, s.* FROM $db s, (select @rownum:=0) tmp ORDER by event_date_time) test where $category = '$search' ORDER BY no DESC LIMIT $page_start, $list";
    
  }


  $result = $conn->query($sql);
 
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<td>".$row["no"]."</td><td>" . $row["adid"]. "</td><td>" . $row["idfv"]. "</td><td>" . $row["model"].
			"</td><td>". $row["country"]."</td><td>". $row["detail_event_name"]."</td><td>".$row["event_date_time"]."</td>";
			echo "</tr>";
    }
  } else {
    echo "There is no result.";
  }
  ?>

  </table>
      </div>
      <div class="col-md-1"></div>
    </div>
  <div class="row center-block">
            <div class="col-md-1"></div>
            <div class="col-md-10 centered">
              <ul class="pagination centered">

  <?php
    if(($search == 1)&&($category == 'category' || $category == 1 )){    
              
              // 처음 버튼
          if ($page <= 1) {
            // 맨 첫페이지에 있을 때 아예 안보이게 하
                echo '<li class="page-item"><a class="page-link" style="color: gray" disabled>first</a></li>';

              } else {
                  echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page=1">first</a></li>';
              }
            
              // 이전으로 돌아가는 버튼
              if ($page <= 1) {
              // 맨 첫페이지면 이전이 필요없음
                  echo '<li class="page-item"><a class="page-link" style="color: gray">previous</a></li>';
              } else {
                  $pre = $page - 1;
                  echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$pre.'">previous</a></li>';
              }
            
              for ($i=$block_start; $i <= $block_end ; $i++) {
                  if ($page == $i) {
                      echo '<li class="page-item"><a class="page-link" style="color: red" href="showpostback.php?a='.$db.'&page='.$i.'">'.$i.'</a></li>';
                  } else{
                      echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$i.'">'.$i.'</a></li>';
                  }
              }
            // 다음 버튼
              if ($page >= $total_page) {
                echo '<li class="page-item"><a class="page-link" style="color: gray">next</a></li>';
              } else {
                $next = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$next.'">next</a></li>';
              }
            
            // 끝 버튼
              if ($page >= $total_page) {
                echo '<li class="page-item"><a class="page-link" style="color: gray">end</a></li>';
              } else {
                echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$total_page.'">end</a></li>';
              }
              $conn->close();

    } else {
      
          // 처음 버튼
          if ($page <= 1) {
                  echo '<li class="page-item"><a class="page-link" style="color: gray">first</a></li>';
              } else {
                  echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page=1&category='.$category.'&search='.$search.'">first</a></li>';
              }
            
              // 이전으로 돌아가는 버튼
              if ($page <= 1) {
                echo '<li class="page-item"><a class="page-link" style="color: gray">previous</a></li>';
              } else {
                  $pre = $page - 1;
                  echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$pre.'&category='.$category.'&search='.$search.'">previous</a></li>';
              }
            
              for ($i=$block_start; $i <= $block_end ; $i++) {
                  if ($page == $i) {
                      echo '<li class="page-item"><a class="page-link" style="color: red" href="showpostback.php?a='.$db.'&page='.$i.'&category='.$category.'&search='.$search.'">'.$i.'</a></li>';
                  } else{
                      echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$i.'&category='.$category.'&search='.$search.'">'.$i.'</a></li>';
                  }
              }
            // 다음 버튼
              if ($page >= $total_page) {
                echo '<li class="page-item"><a class="page-link" style="color: gray">next</a></li>';
              } else {
                $next = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$next.'&category='.$category.'&search='.$search.'">next</a></li>';
              }
            // 끝 버튼
              if ($page >= $total_page) {
                echo '<li class="page-item"><a class="page-link" style="color: gray">end</a></li>';
              } else {
                echo '<li class="page-item"><a class="page-link" href="showpostback.php?a='.$db.'&page='.$total_page.'&category='.$category.'&search='.$search.'">end</a></li>';
              }
              $conn->close();
  }

  ?>
        </ul>
          </div>
        <div class="col-md-1"></div>
      </div>
      <div class = "row">
          <div class ="col-md-1"></div>
          <div class ="col-md-10">
              <?php
                $selected2 = $_GET['category'];
              ?>
              <div class="input-group-prepend">
                <select class = "selectpicker" id = "selector">
                  <option class = "query" value = "category"
                  <?php
                    if(isset($selected2) && ($selected2 == 'category')){
                      echo 'selected';
                    } else {
                      
                    }
                  ?>
                  >category</option>
                  <option class = "query" value = "adid"
                  <?php
                    if(isset($selected2) && ($selected2 == 'adid')){
                      echo 'selected';
                    } else {
                      
                    }
                  ?>
                  >adid</option>
                  <option class = "query" value = "idfv"
                  <?php
                    if(isset($selected2) && ($selected2 == 'idfv')){
                      echo 'selected';
                    } else {
                      
                    }
                  ?>
                  >idfv</option>
                  <option class = "query" value = "country"
                  <?php
                    if(isset($selected2) && ($selected2 == 'country')){
                      echo 'selected';
                    } else {
                      
                    }
                  ?>
                  >country</option>
                  <option class = "query" value = "detail_event_name"
                  <?php
                    if(isset($selected2) && ($selected2 == 'detail_event_name')){
                      echo 'selected';
                    } else {
                      
                    }
                  ?>
                  >detail_event_name</option>
                </select> 
                <input type="text" class="form-control" id = "search" onkeyup = "enterkey()" placeholder="saerch whatever you want">
                <button class="btn btn-success" onclick="search()">search</button>
              </div>
          </div>
          <div class ="col-md-1"></div>
      </div>
    </div>
  </div>
  <br><br><br>
</body>
</html>
