<?php

	//open connection
$db = mysqli_connect("localhost","root","","library");

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
}

	
	
	
	//$result = mysqli_query($db, "select user_id from users where user_id = '".$_POST['user_id']."'");
	$stmt = $db->prepare("select user_id from users where user_id = ?");
	$stmt->bind_param("s",$_POST['user_id']);
	
	if($_POST['user_name']== ""  || $_POST['user_id']== "" || $_POST['password']== "" || $_POST['confirm_password']== "" || ($_POST['security_question']== "Other" && $_POST['otherquestion']=="") || $_POST['security_answer']== "")
	{
		echo "<span class='error'>Please fill in all fields</span>";
	}
	else
	{
		if($stmt->num_rows == 1)
		{
			echo "<span class='error'>This username is already taken.</span>";
		}
		else
		{
			//check passwords are the same
			if($_POST['password'] != $_POST['confirm_password'])
			{
				header("location: register.php?passmismatch=1");
			}
			else
			{
				if($_POST['security_question'] == "Other")
				{
					$question = htmlentities($_POST["otherquestion"]);
				}
				else
				{
					
					$question = htmlentities($_POST['security_question']);
				}
				
				$question = str_replace("'","''",$question);
				echo $question;
				$stmt->close();
				$hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT);
				//$sql = "INSERT INTO users (user_name,user_id, password, security_question, security_answer) VALUES ('".$_POST['user_name']."','".$_POST['user_id']. "','".password_hash($_POST['password'], PASSWORD_DEFAULT)."','". htmlentities($question) ."','".$_POST['security_answer']."')";
				$stmt = $db->prepare("INSERT INTO users (user_name,user_id, password, security_question, security_answer) VALUES (?,?,?,?,?)");
				$stmt->bind_param("sssss",$_POST['user_name'],$_POST['user_id'],$hashed_password,$question,$_POST['security_answer']);
				if ($stmt->execute()) 
				{
					$stmt->close();
					header("location: login.php");
				} 
				else 
				{
					echo "Error: " . $sql . "<br>" . $db->error;
                    header("location: register.php?duplicateid=1");
				}
			}
		}
	}
		

    
    // Close connection
	mysqli_close($db);
?>
