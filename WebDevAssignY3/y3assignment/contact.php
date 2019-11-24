<!DOCTYPE html>
<html lang="en">
<?php
// Initialize the session
session_start();

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
                            <input type="image" value="Search" style="width:1.5em; vertical-align:middle; " src="pics/search_icon.png">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Contact us form referenced from: https://bootsnipp.com/snippets/83Br -->
    <div class="container-fluid text-center">
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="well well-sm">
                        <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <legend class="text-center">Contact us</legend>

                                <!-- Name input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="firstname">First Name</label>
                                    <div class="col-md-9">
                                        <input id="firstname" name="firstname" type="text" placeholder="Your first name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="lastname">Last Name</label>
                                    <div class="col-md-9">
                                        <input id="lastname" name="lastname" type="text" placeholder="Your last name" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Email input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email">Your E-mail</label>
                                    <div class="col-md-9">
                                        <input id="email" name="email" type="email" placeholder="Your email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="subject">Subject</label>
                                    <div class="col-md-9">
                                        <input id="subject" name="subject" type="text" placeholder="Subject of inquiry" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Message body -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="comments">Your Comments</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="comments" name="comments" placeholder="Please enter your message here..." rows="5" required></textarea>
                                    </div>
                                </div>

                                <!-- Form actions -->
                                <div class="form-group">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg" id="subbut">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <span id="userprompt"></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
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
			echo '<script>document.getElementById("userprompt").innerHTML = "Comment Succesfully sent";</script>';
            echo '<script>document.getElementById("userprompt").style.color = "green"</script> ';
		}
		else
		{
			echo '<script>document.getElementById("userprompt").innerHTML = "Your Comment could not be sent.";</script>';
            echo '<script>document.getElementById("userprompt").style.color = "red"</script> ';
		}
			
    }
    
    // Close connection
	mysqli_close($db);
?>
</body>

</html>
