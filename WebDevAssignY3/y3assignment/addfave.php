<?php
	session_start();
	$db = mysqli_connect("localhost","root","","library");
	//if($_SERVER["REQUEST_METHOD"] == "POST")
	//{
		if (mysqli_connect_errno())
		{
			echo "failed to connect to database";
		}
	//}
	//$validationquery = mysqli_query($db,"select book_ISBN from favourites where user_id like '".$_SESSION["id"]."' and book_ISBN like'".$_GET["ISBN"]."'");
	//$row = mysqli_fetch_row($validationquery);
	$stmt = $db->prepare("select book_ISBN from favourites where user_id like ? and book_ISBN like ?");
	$stmt->bind_param("ss",$_SESSION["id"],$_GET["ISBN"]);
	$stmt->execute();
	$stmt->bind_result($col1);
	$stmt->fetch();
	if($col1 == $_POST["ISBN"])
	{
		echo ("<script>alert('This book has already been added to favourites'); </script>");
		$stmt->close();
	}
	else
	{
		//$sql = "insert into favourites (user_id, book_ISBN) values ('".$_SESSION['id']."','".$_POST['ISBN']."')";
		$stmt->close();
		$stmt = $db->prepare("insert into favourites (user_id, book_ISBN) values (?,?)");
		$stmt->bind_param("ss",$_SESSION['id'],$_POST['ISBN']);
		
		if ($stmt->execute()) 
		{
			//header("location: search.php");
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $db->error;
		}
		
	}
?>


