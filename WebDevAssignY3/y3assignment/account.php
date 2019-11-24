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

?>

<!DOCTYPE html>
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
                    <li class="active" id="account_button"><a id="account_link" href="account.php">My Account <?php 
					
					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
					{
						//prepare statement
						$stmt = $db->prepare("select profile_pic_path from users where user_id like ?");
						$stmt->bind_param("s",$_SESSION["id"]);
						
						$stmt->execute();
						
						$stmt->bind_result($col1);
						
						$stmt->fetch();
						
						$stmt->close();
						
						
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
            <div class="col-sm-12 text-left">
                <h1><?php echo $_SESSION[user_name]; ?>'s Account</h1>
                <?php 
			$picquery = $db->prepare("select profile_pic_path from users where user_id like ?");;
			//check if null
			$stmt->bind_param("s",$_SESSION["id"]);
			
			$stmt->execute();
			$stmt->bind_result($col1);
			$stmt->fetch();
			if($col1 === NULL)
			{
				$pic_path = 'pics/default.jpg';
			}
			else
			{
				$pic_path = $col1;
			}
		 ?>
                <img src='<?php echo $pic_path ?>' style="height: 100px; width: 100px" />
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <br>
                    <input type="file" name="uploadfile" id="uploadfile">
                    <br>
                    <input type="submit" value="Upload Image" name="submit" class="btn btn-primary btn-md">
                </form>


                <div class="table-responsive">
                    <h2>Favourites</h2>
                    <table class="searchtable" id="sresults">
                        <thead>
                            <tr>
                                <td>
                                    Book Name
                                </td>
                                <td>
                                    Author
                                </td>
                                <td>
                                    ISBN
                                </td>
                                <td>
                                    Year of Publication
                                </td>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
					$sessionName = $_SESSION["id"];
					$sql = "select book_name,book_author,book_ISBN, year_published from book join favourites using (book_ISBN) join users using (user_id) where user_id = ?";
					
					$stmt = $db->prepare($sql);
					
					$stmt->bind_param('s',$sessionName);
					$sessionName = $_SESSION["id"];
					
					$stmt->execute();
					
					$stmt->bind_result($col1,$col2,$col3,$col4);
					
					
					while ($stmt->fetch())
					{
						echo "<tr><td>";
						echo $col1;
						echo ("</td><td>");
						echo $col2;
						echo ("</td><td>");
						echo $col3;
						echo ("</td><td>");
						echo $col4;
						echo ("</td><td>");
						
						echo ("<a href='remove.php?ISBN=".htmlentities($col3)."'>remove</a>");
						echo ("</td></tr>");
						
					}
					$stmt->close();
				?>
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <br>
                <button id="delete_account_button" onclick="show_delete_form()" class="btn btn-primary btn-md">Delete Account </button>
                <form id="delete_account_form" method="POST" style="display: none" action="delete_user.php">
                    <span>Are you sure you want to delete your account? </span>
                    <input type="submit" value="Yes, I am sure." class="btn btn-primary btn-md">
                </form>
                <br>
                <br>
                <br>
            </div>

        </div>
    </div>
    <script>
        function show_delete_form() {
            document.getElementById('delete_account_form').style.display = 'block';
        }

    </script>
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
//connect to database
$db = mysqli_connect("localhost","root","","library");

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
}
?>
</body>

</html>
