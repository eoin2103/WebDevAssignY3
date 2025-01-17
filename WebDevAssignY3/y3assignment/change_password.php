<!DOCTYPE html>
<html lang="en">

<head>
    <title>Joe's Library</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="icon" type="x-icon/image" href="bookbicon.png">
    <link href="https://fonts.googleapis.com/css?family=Google+Sans:400,500&lang=en" rel="stylesheet">


</head>
<?php

session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
	{
		header("location:account.php");
	}
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
error_reporting(0);


?>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="bookbicon.png" class="logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li id="home_button"><a id="home_link" href="index.php">Home</a></li>
                    <li id="search_button"><a id="search_link" href="search.php">Search</a></li>
                    <li id="account_button"><a id="account_link" href="account.php">My Account <?php 
					
					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
					{
						//prepare statement
						$stmt = $db->prepare("select profile_pic_path from users where user_id like ?");
						$stmt->bind_param("s",$_SESSION["id"]);
						
						//$sessionName = ;
						$stmt->execute();
						
						$stmt->bind_result($col1);
						
						$stmt->fetch();
						
						$stmt->close();
						
						//$nav_bar_prof_pic_query = mysqli_query($db,"select profile_pic_path from users where user_id like '".$_SESSION["id"]."'");
						
						
						
						//$nav_pic_query_row = mysqli_fetch_row($nav_bar_prof_pic_query);
						
						if($$col1 === NULL)
						{
							$nav_pic = 'pics/default.jpg';
						}
						else
						{
							$nav_pic = $$col1;
						}
						
						echo "<img src='".$col1."' style='width: 1.5em; border-radius: 25px;'>";
						
					}
					
					?></a></li>
                    <li id="contact_button"><a id="contact_link" href="contact.php">Contact</a></li>
                </ul>
                <?php
				if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
				{
					echo '<ul class="nav navbar-nav navbar-right">';
					echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
					echo '</ul>';
				}
				else
				{
					echo '<ul class="nav navbar-nav navbar-right">';
					echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
					echo '</ul>';
					echo '<ul class="nav navbar-nav navbar-right">';
					echo '<li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>';
					echo '</ul>';
				}
				?>
                <ul class="nav navbar-nav navbar-right ">
                    <li>
                        <form method="post" class="navsearch" action="search.php">
                            <input type="text" name="search" Placeholder="Look up books or authors" />
                            <input type="image" value="Search" style="width:1.5em; vertical-align:middle; " src="pics/search_icon.png">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">

        <div class="row content">
            <!--
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
	-->

            <div class="col-sm-12 text-left">
                <h1>Password Reset</h1>
                <!--
		  <form action="" method="post">
				
                
				<label>Please enter your User ID</label>
                <input type="text" name="cpw_user_id" value="">
                <br>
				<input type="submit" class="" value="Submit">
		  </form>
		-->
                <?php
$db = mysqli_connect("localhost","root","","library");
if (mysqli_connect_errno())
	{
		echo "failed to connect to database";
	} 


	if(!isset($_POST["cpw_user_id"]))
	{
		
		echo "<form action='' method='post'>";      
		echo "<label>Please enter your User ID</label>";
		echo "<input type='text' name='cpw_user_id' class='form-control' style='width:30%';' />";
		echo "<br>";
		echo '<input type="submit" class="btn btn-primary btn-md" value="Submit">';
		echo "</form>";
		
	}
	else
	{
		
		//$result = mysqli_query($db, "select user_name, password, user_id, security_question from users where user_id like '".$_POST['cpw_user_id']."';");
		$stmt = $db->prepare("select user_name, password, user_id, security_question from users where user_id like ?");
		$stmt->bind_param("s",$_POST['cpw_user_id']);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		//check if username exists in db
		$stmt->bind_result($col1,$col2,$col3,$col4);
		
		echo "<b>Username:".$_POST["cpw_user_id"]."</b><br>";
		echo "Not your username? click <a href='clearpost.php'>here</a>";
		$stmt->fetch();
		//echo $col1.$col2.$col3.$col4;
		if($rows == 0)
		{
			echo "<span class='error'>Username does not exist!</span>";
			
		}
		else
		{
			
			//$row = mysqli_fetch_row($result);
			echo "<form action='pwreset.php' method='post'>";
					
					
			echo "<label>".$col4."</label><br>";
			echo "<input type='text' name='cpw_answer' value=''class='form-control' style='width:30%';' >";
			echo "<br>";
			echo "<label>Enter new Password</label><br>";
			echo "<input type='password' name='newpw' class='form-control' style='width:30%';' ></input><br>";
			echo "<label>Confirm new Password</label><br>";
			echo "<input type='password' name='confirmnewpw' class='form-control' style='width:30%';' ></input><br>";
			echo "<input type='submit' class='btn btn-primary btn-md' value='Submit'>";
			echo "<input type='hidden' name='cpw_user_id' value='".$_POST["cpw_user_id"]."'/>";
			echo "</form>";
		}
		
	}
	
	if($_SESSION["wrong_answer"] == 1)
	{
		echo "<span>Incorrect Answer</span><br>";
		$_SESSION["wrong_answer"] = 0;
	}
	if($_SESSION["wrong_id"] == 1)
	{
		echo "<span>That User ID does not exist</span><br>";
		$_SESSION["wrong_id"] = 0;
	}

?>
                <br>
                <span>Don't have an account? Register <a href="register.php">here</a></span>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <!--
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
	-->
        </div>
    </div>

    <div class="bottom section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright">
                        <p>© <span>2019</span> <a href="contact.php" class="transition">Stephen and Eoin</a> All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
