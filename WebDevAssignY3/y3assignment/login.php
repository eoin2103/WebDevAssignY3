<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

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

<body>

    <script>
        function checkActiveNav(navButtonId, navLinkId) {
            navButton = document.getElementById(navButtonId);
            navLink = document.getElementById(navLinkId);
            linkHref = navLink.href.split("/").pop();
            console.log(linkHref);
            currentPage = currentPageName();

            if (currentPage === linkHref) {
                navButton.classList.add('active');
                console.log(navButton.id);
            }
        }

        function currentPageName() {
            var path = window.location.pathname;
            var page = path.split("/").pop();
            console.log(page);
            return (page);
        } //taken from https://stackoverflow.com/questions/16611497/how-can-i-get-the-name-of-an-html-page-in-javascript

        function pageLoaded() {
            checkActiveNav('home_button', 'home_link');
            checkActiveNav('search_button', 'search_link');
            checkActiveNav('account_button', 'account_link');
            checkActiveNav('contact_button', 'contact_link');
        }

    </script>



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
    <!-- Login Referanced From: https://bootsnipp.com/snippets/k7MqR -->
    <div class="container-fluid text-center">
        <br>
        <br>
        <br>
        <div class="row content">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-login">
                        <h4>Welcome back.</h4>
                        <form method="post" action="">
                            <input type="text" id="user_id" name="user_id" class="form-control input-sm chat-input" placeholder="username" />
                            <br>
                            <input type="password" id="password" name="password" class="form-control input-sm chat-input" placeholder="password" />
                            <br>
                            <div class="wrapper">
                                <span class="group-btn">
                                    <button type=submit class="btn btn-primary btn-md">Login <i class="fa fa-sign-in"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <br>
                    <span>Can't remember password? Click <a href="change_password.php">here</a> to change it.</span><br>
                    <span>Don't have an account? Register <a href="register.php">here</a></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

            <?php
$db = mysqli_connect("localhost","root","","library");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (mysqli_connect_errno())
	{
		echo "failed to connect to database";
	} 

	//$result = mysqli_query($db, "select user_name, password, user_id from users where user_id like '".$_POST['user_id']."'");
	$stmt = $db->prepare("select user_name, password, user_id from users where user_id like ?");
	$stmt->bind_param("s",$_POST['user_id']);
	$stmt->execute();
	$stmt->store_result();
	$cols = array();
	$stmt->bind_result($cols[0],$cols[1],$cols[2]);
	
	
	//check if username exists in db
	if($stmt->num_rows == 0)
	{
		echo "<span class='error'>Username does not exist</span>";
	}
	else
	{
		$stmt->fetch();
		//check if password is correct
		//if($_POST['password'] == password_verify(htmlentities($row[1])))
		if(password_verify($_POST['password'], $cols[1] ) )
		{
			//initialise session
			
                            
			
			$_SESSION["loggedin"] = true;
			$_SESSION["id"] = $cols[2];
			$_SESSION["user_name"] = $cols["0"];
			echo "<script type='text/javascript'> window.location.href = 'account.php';</script>";
		}
		else
		{
			echo "<span class='error'>Password is incorrect.</span>";
		}
	}
}
?>



        </div>

    </div>

    <div class="bottom section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright">
                        <p>© <span>2018</span> <a href="#" class="transition">Speev nd Own</a> All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
