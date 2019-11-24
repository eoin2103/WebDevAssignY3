<?php
session_start();
$db = mysqli_connect("localhost","root","","library");
if (mysqli_connect_errno())
	{
		echo "failed to connect to database";
	}
	
//$result = mysqli_query($db, "select security_question, security_answer from users where user_id like '".$_POST['cpw_user_id']."'");
$stmt = $db->prepare("select security_question, security_answer from users where user_id like ?");
$stmt->bind_param("s",$_POST['cpw_user_id']);

$stmt->execute();
$stmt->store_result();
if($stmt->num_rows == 0)
{
	$stmt->close();
	$_SESSION["wrong_id"] = 1;
	//header("location: change_password.php");
}

//$result = mysqli_query($db, "select security_question, security_answer from users where user_id like '".$_POST['cpw_user_id']."'");
//$row = mysqli_fetch_row($result);
$stmt->bind_result($col1,$col2);
$stmt->fetch();
if($_POST["newpw"] == $_POST["confirmnewpw"])
{
	if($_POST["cpw_answer"] == $col2)
	{
		$stmt->close();
		$new_pw = password_hash($_POST["newpw"],PASSWORD_DEFAULT);
		//$sql = ("update users set password = '".$_POST["newpw"]."' where user_id like '".$_POST['cpw_user_id']."'");
		$stmt = $db->prepare("update users set password = ? where user_id like ?");
		$stmt->bind_param("ss",$new_pw,$_POST['cpw_user_id']);
		if ($stmt->execute()) 
		{
			header("location: login.php");
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $db->error;
		}
	}
	else
	{
		$_SESSION["wrong_answer"] = 1;
		header("location: change_password.php");
	}
}


?>