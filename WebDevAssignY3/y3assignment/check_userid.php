<?php
//require_once("DBController.php");
//$db_handle = new DBController();
	//open connection
$db = mysqli_connect("localhost","root","","library");

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
}

if(!empty($_POST["userid"])) {
  //$query = mysqli_query($db, "SELECT * FROM users WHERE user_id like '" . $_POST["userid"] . "'");
  $stmt = $db->prepare("SELECT * FROM users WHERE user_id like ?");
  $stmt->bind_param("s",$_POST["userid"]);
  $stmt->execute();
  $stmt->store_result();
  //$namecount = mysqli_fetch_row($result);
  //$user_count = $db_handle->numRows($query);
  if($stmt->num_rows != 0) {
      echo "<span style='color:red' class='status-not-available'> User ID Not Available.</span>";
  }else{
      echo "<span style='color:green' class='status-available'> User ID Available.</span>";
  }
}
?>