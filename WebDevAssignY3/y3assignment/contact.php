<!DOCTYPE html>
<html lang="en">
<?php
// Initialize the session
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
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

?>
<head>
    <title>Joe's Library</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="icon" type="x-icon/image" href="bookbicon.png">
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://fonts.googleapis.com/css?family=Google+Sans:400,500&lang=en" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body onload="pageLoaded()">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="bookbicon.png" class="logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li id="home_button"><a id="home_link"href="index.php">Home</a></li>
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
                    <li class="active" id="contact_button"><a id="contact_link" href="contact.php">Contact</a></li>
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
                            <input  type="image" value="Search"  style="width:1.5em; vertical-align:middle; " src="pics/search_icon.png" ></button>
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
                <div class="contactContainter">
                    <h1>Contact Us</h1>
                    <span>Please fill in all fields</span>
                    <br>
                    <br>
                    <form action="" method="post">

                        <label for="fname">First Name</label>
                        <br>
                        <input required type="text" id="firstname" name="firstname" placeholder="Your name..">
                        <br>
                        <label for="lname">Last Name</label>
                        <br>
                        <input type="text" id="lastname" name="lastname" placeholder="Your last name..">
                        <br>
                        <label for="email">Email</label>
                        <br>
                        <input type="email" id="email" name="email" placeholder="Your Email..">
                        <br>
                        <label for="subject">Subject</label>
                        <br>
                        <select id="subject" name="subject">
                            <option selected="selected">Choose a subject...</option>
                            <option value="Book Request">Book Request</option>
                            <option value="Technical Error">Technical Error</option>
                            <option value="Other">Other</option>
                        </select>
                        <br>
                        <label for="comments">Comments *</label>
                        <br>
                        <textarea required id="comments" name="comments" placeholder="Write Comments Here.." style="height:100px; width:200px"></textarea>
                        <br>

                        <input type="submit" value="Submit">
                        <br>
                        <br>

                    </form>
                </div>
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

  <footer class="footer">
        <p>© 2019 Eoin and Stephen, All Rights Reserved. Contact Us:
            <a href="mailto:c17400202@mytudublin.ie?Subject=Joes-Library" target="_top" style="color: #ffffff">C17400202@mytudublin.ie</a></p>
    </footer>
    <?php
	//open connection
$db = mysqli_connect("localhost","root","","library");

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
} 
//process data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$stmt = $db->prepare("insert into contact (contact_first_name,contact_surname,contact_email,contact_subject,contact_comments) values (?,?,?,?,?)");
		$stmt->bind_param("sssss",$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['subject'],$_POST['comments']);
		if($stmt->execute())
		{
			echo "Comment succesfully sent";
		}
		else
		{
			echo "Your comment could not be sent";
		}
			
    }
    
    // Close connection
	mysqli_close($db);
?>
</body>

</html>
