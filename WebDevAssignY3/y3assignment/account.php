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
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="mystyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="info.php">My Account</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
      <h1><?php echo $_SESSION[user_name]; ?>'s Account</h1>
	  <h2>Favourites</h2>
		  <table class = "searchtable">
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
					<td>
						Availability
					</td>
					<td>
						
					</td>
				</tr>
			  </thead>
			  <tbody>
				<?php
					$result = mysqli_query($db,"select book_name,book_author,book_ISBN, year_published from book join favourites using (book_ISBN) join users using (user_id) where user_id like '".$_SESSION["id"]."'");
					while ($row = mysqli_fetch_row($result))
					{
						echo "<tr><td>";
						echo (htmlentities($row[0]));
						echo ("</td><td>");
						echo (htmlentities($row[1]));
						echo ("</td><td>");
						echo (htmlentities($row[2]));
						echo ("</td><td>");
						echo (htmlentities($row[3]));
						echo ("</td><td>");
						echo (htmlentities($row[4]));
						echo ("</td><td>");
						echo ("<a href=''>remove</a>");
						echo ("</td></tr>");
						
					}
				?>
			  </tbody>
		  </table>
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

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
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