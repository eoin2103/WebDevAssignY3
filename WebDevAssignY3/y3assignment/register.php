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
	<script src="libraryjs.js"></script>
</head>
<?php
	//open connection
$db = mysqli_connect("localhost","root","","library");

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
}
?>
<body>

<script>
function checkActiveNav(navButtonId,navLinkId)
{
	navButton = document.getElementById(navButtonId);
	navLink = document.getElementById(navLinkId);
	linkHref = navLink.href.split("/").pop();
	console.log(linkHref);
	currentPage = currentPageName();
	
	if(currentPage === linkHref)
	{
		navButton.classList.add('active');
		console.log(navButton.id);
	}
}
function currentPageName()
{
	var path = window.location.pathname;
	var page = path.split("/").pop();
	console.log(page);
	return( page );
}//taken from https://stackoverflow.com/questions/16611497/how-can-i-get-the-name-of-an-html-page-in-javascript

function pageLoaded()
{
	checkActiveNav('home_button','home_link');
	checkActiveNav('search_button','search_link');
	checkActiveNav('account_button','account_link');
	checkActiveNav('contact_button','contact_link');
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
     <div class="container-fluid text-center">

        <div class="row content">

            <div class="col-sm-12 text-left">
	 
		  <form action="createuser.php" method="post">
				<h1>Register</h1>
                <label>Name</label>
				<br>
                <input type="text" name="user_name" class="" value="">
                <br>
				<label>User ID</label>
				<br>
                <input type="text" name="user_id" value="" onblur="userIdAvailability()" id="user_id">
				<script>
					function userIdAvailability()
					{
						$("#id-availability").hide();
						jQuery.ajax({
							url: "check_userid.php",
							data: 'userid='+$("#user_id").val(),
							type: "POST",
							success:function(data){
								$("#id-availability").html(data);
								$("#id-availability").fadeIn(1000);
							},
							error:function (){}
						});
					}
				</script>
				<span id="id-availability"> </span>
                <br>
                <label>Password</label>
				<br>
                <input type="password" name="password" class="" value="">
                <br>
            
            
                <label>Confirm <br> Password</label>
				<br>
                <input type="password" name="confirm_password" class="" value="">
                <br>
				<label>Security <br>Question</label>
				<br>
                <select  name="security_question" class="" value="" onchange='checkother(this.value)'>
				<?php
				$result = mysqli_query($db, "select question_text from questions");
				
				while ($row = mysqli_fetch_row($result))
				{
					
					$optionquestion = $row[0];
					$optionquestion = str_replace("'","&#39",$optionquestion);
					echo("<option value='".$optionquestion."'>".$optionquestion."</option>");
				}
				?>
				<option>Other</option>
				
				</select>
				<label id="otherQuestionLabel" style="display:none;" for="otherquestion">Enter your question</label>
				<textarea id="otherquestion" name="otherquestion" style="display:none;">
				</textarea>
                <br>
				<label>Security <br>Answer</label>
				<br>
                <input type="text" name="security_answer" class="" value="">
                <br>
            
                <input type="submit" class="" value="Submit">
		  </form>
		  </div>
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
//process data when form is submitted
/*

	*/
?>
</body>
</html>
