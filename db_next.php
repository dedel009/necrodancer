<?php
    $id   = $_POST["id"];

    echo $id;

    $con = mysqli_connect("localhost", "user1", "12345", "sample");

	$sql = "insert into members(num, id)";
	$sql .= "values(0, '$id')";

	mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'db_last.php';
	      </script>
	  ";
?>
