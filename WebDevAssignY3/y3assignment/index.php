<!DOCTYPE html>
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
                    <li class="active" id="home_button"><a id="home_link" href="index.php">Home</a></li>
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
        <div class="content">
            <div class="row content">
                <div class="col-md-offset-3 col-md-6 text-left">
                    <div class="signupcontainer">
                        <img src="library.jpg" alt="books" class="bookshome">
                        <div class="signup">
                            <div class="signupcentered">
                                <button class="signupbutton" onclick="window.location.href = 'register.php'">Sign Up For Free Today!</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h1>About Joe's</h1>
                    <p>
                        Joe's Library was founded in 2019 by its founding fathers Stephen Healy and Eoin Gallagher and named in honor of Joe Momovic. It was created with a single goal in mind: provide a place for people to find and read books. It is located at the heart of Dublin city center. We provide a wide range of books from many authors spanning across many genre. If you are interested, pop in and say hello.
                    </p>
                    <p>
                        Navigating your way through the wealth of information resources the Library makes available can be a daunting task. Library staff provide support, help and training to enable you to get to grips with the literature of your subject and the Library's resources. We have staff with expertise on information resources in your subject area, who are here to support you with your studies, research, or teaching.
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Referenced From: https://bootsnipp.com/snippets/lGEO2  -->
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
