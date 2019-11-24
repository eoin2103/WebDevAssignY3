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
	
		
		//$sql = "delete from favourites where (user_id = '".$_SESSION['id']."' and book_ISBN = '".$_GET['ISBN']."')";
		$stmt = $db->prepare("delete from favourites where (user_id = ? and book_ISBN = ?)");
		$stmt->bind_param("ss",$_SESSION['id'],$_GET['ISBN']);
		
		if ($stmt->execute()) 
		{
			$stmt->close();
			header("location: account.php");
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $db->error;
		}
		
	//header("location: search.php");
?>