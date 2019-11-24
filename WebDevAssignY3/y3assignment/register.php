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

error_reporting(0);
?>

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
    <div class="container-fluid text-center">

        <div class="row content">

            <div class="container-fluid text-center">

                <div class="row content">

                    <div class="col-sm-12 text-left">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="well well-sm">
                                        <form class="form-horizontal" action="createuser.php" method="post">
                                            <fieldset>
                                                <legend class="text-center">Register</legend>

                                                <!-- Name input-->
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="user_name">Name</label>
                                                    <div class="col-md-9">
                                                        <input id="user_name" name="user_name" type="text" placeholder="Your name" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="lastname">User ID</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="user_id" value="" onblur="userIdAvailability()" id="user_id" class="form-control">
                                                        <script>
                                                            function userIdAvailability() {
                                                                $("#id-availability").hide();
                                                                jQuery.ajax({
                                                                    url: "check_userid.php",
                                                                    data: 'userid=' + $("#user_id").val(),
                                                                    type: "POST",
                                                                    success: function(data) {
                                                                        $("#id-availability").html(data);
                                                                        $("#id-availability").fadeIn(1000);
                                                                    },
                                                                    error: function() {}
                                                                });
                                                            }

                                                        </script>
                                                        <span id="id-availability"> </span>
                                                    </div>
                                                </div>

                                                <!-- Email input-->
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="password">Password</label>
                                                    <div class="col-md-9">
                                                        <input id="password" name="password" type="password" placeholder="Your password" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="confirm_password">Confirm Password</label>
                                                    <div class="col-md-9">
                                                        <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm your password" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="security_question">Security Question</label>
                                                    <div class="col-md-9">
                                                        <select name="security_question" class="form-control" value="" onchange='checkother(this.value)'>
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
                                                        <input id="otherquestion" name="otherquestion" style="display:none;" type="text" lass="form-control">
                                                    </div>
                                                </div>

                                                <!-- Message body -->
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="security_answer">Security Answer</label>
                                                    <div class="col-md-9">
                                                        <input id="security_answer" name="security_answer" type="security_answer" placeholder="Your Answer" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Form actions -->
                                                <div class="form-group">
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" class="btn btn-primary btn-lg" id="subbut">Sign Up!</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        <span id="reg_error"> </span>
                                        <?php
                                        if ($_GET["duplicateid"] == 1)
                                        {
                                            echo '<script>document.getElementById("reg_error").innerHTML = "ERROR! User account already Exists";</script>';
                                            echo '<script>document.getElementById("reg_error").style.color = "red"</script> ';
                                        }
                                        if ($_GET["passmismatch"] == 1)
                                        {
                                            echo '<script>document.getElementById("reg_error").innerHTML = "ERROR! Passwords do not match";</script>';
                                            echo '<script>document.getElementById("reg_error").style.color = "red"</script> ';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
