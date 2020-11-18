<!DOCTYPE html>
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="hidden" name="fname" value="test!!!!">
  <input type="submit">
</form>

<?php
    $name = $_POST['fname'];
        echo $name;
?>

</body>
</html>
