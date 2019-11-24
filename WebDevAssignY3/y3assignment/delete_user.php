<?php
session_start();
$db = mysqli_connect("localhost","root","","library");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (mysqli_connect_errno())
	{
		echo "failed to connect to database";
	}
}

//$sql = "delete from favourites where user_id = '".$_SESSION["id"]."'";
$stmt = $db->prepare("delete from favourites where user_id = ?");
$stmt->bind_param("s",$_SESSION["id"]);

;
if ($stmt->execute()) 
{
	$stmt->close();
	//$sql = "delete from users where user_id = '".$_SESSION["id"]."'";
	$stmt = $db->prepare("delete from users where user_id = ?");
	$stmt->bind_param("s",$_SESSION["id"]);
	if ($stmt->execute()) 
	{
		
		$stmt->close();
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		header("location: index.php");
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $db->error;
	}
} 
else 
{
	echo "Error: " . $sql . "<br>" . $db->error;
}
//$sql = "delete from users where user_id = '".$_SESSION["id"]."'";
?>