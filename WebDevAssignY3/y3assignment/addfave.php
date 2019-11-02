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
	$validationquery = mysqli_query($db,"select book_ISBN from favourites where user_id like '".$_SESSION["id"]."' and book_ISBN like'".$_GET["ISBN"]."'");
	$row = mysqli_fetch_row($validationquery);
	if($row[0] == $_GET["ISBN"])
		echo ("<script>alert('This book has already been added to favourites'); </script>");
	else
		$sql = "insert into favourites (user_id, book_ISBN) values ('".$_SESSION['id']."','".$_GET['ISBN']."')";
		header("location: search.php");
		if ($db->query($sql) === TRUE) 
		{
			header("location: search.php");
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $db->error;
		}
		//echo ("<script>alert('CHOGGLY'); </script>");
	//header("location: search.php");
?>