<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$db = mysqli_connect("localhost","root","","library");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (mysqli_connect_errno())
	{
		echo "failed to connect to database";
	}
}
error_reporting(0);


 
	//function for appending to file name. Taken from stack overflow - https://stackoverflow.com/questions/5875164/php-add-string-to-filename
	function merge($file, $append)
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$filename = str_replace('.'.$ext, '', $file).$append.'.'.$ext;
		return ($filename);
	}

//taken from w3schools - https://www.w3schools.com/php/php_file_upload.asp
$pic_dir = "pics/";
$pic_file = $pic_dir . basename($_FILES["uploadfile"]["name"]);
$uploadValid = 1;
$imageFileType = strtolower(pathinfo($pic_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploadfile"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadValid = 1;
    } else {
        echo "File is not an image.";
        $uploadValid = 0;
        header("location: account.php");
    }
}
//check if a file with same name exists, if so append a 1
$unique = 0;
while($unique == 0)
{
	if (file_exists($pic_file)) 
	{

		$pic_file = merge($pic_file,'1');
	}
	else
	{
		$unique = 1;
	}
}

// Check file size
if ($_FILES["uploadfile"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadValid = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadValid = 0;
    header("location: account.php");
}
// Check if $uploadOk is set to 0 by an error
if ($uploadValid == 0) {
    echo "Sorry, your file was not uploaded.";
    header("location: account.php");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $pic_file)) 
	{
        echo "The file ". basename( $_FILES["uploadfile"]["name"]). " has been uploaded.";
		//delete old picture from server and assign new as profile picture
		
		$stmt = $db->prepare("select profile_pic_path from users where user_id like ?");
		$stmt->bind_param("s",$_SESSION["id"]);
		$stmt->execute();
		$stmt->bind_result($col1);
		$stmt->fetch();
		$old_pic = $col1;
		if($old_pic !== NULL)
		{
			unlink(realpath($old_pic));
		}
		$stmt->close();
		$stmt = $db->prepare("update users set profile_pic_path = '".$pic_file."' where user_id = '".$_SESSION['id']."'");
		$stmt->bind_param("ss",$pic_file,$_SESSION['id']);
		
		if ($stmt->execute()) 
		{
			header("location: account.php");
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $db->error;
		}
    } 
	else 
	{
        echo "Sorry, there was an error uploading your file.";
        header("location: account.php");
    }
	
}
?>
