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
<?php
session_start();
	//open connection
$db = mysqli_connect("localhost","root","","library");
error_reporting(0);

if (mysqli_connect_errno())
{
	echo "failed to connect to database";
} 

function addtofave()
{
	
	
}
	
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
                    <li class="active" id="search_button"><a id="search_link" href="search.php">Search</a></li>
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
                <h1>Search</h1>
                <form method="post" class="searchform">
                    <input type="text" name="search" />
                    <label for="filter">Filter By:</label>
                    <select id="filter" name="filter">
                        <option value=""></option>
                        <option value="book_name">Title</option>
                        <option value="book_author">Author</option>
                        <option value="book_ISBN">ISBN</option>
                        <option value="year_published">Year of Publication</option>
                    </select>
                    <label for="sort">Sort By:</label>
                    <select id="sort" name="sort">
                        <option value=""></option>
                        <option value="book_name">Title</option>
                        <option value="book_author">Author</option>
                        <option value="book_ISBN">ISBN</option>
                        <option value="year_published">Year of Publication</option>
                    </select>
                    <input type="submit" />
                </form>
                <div class="table-responsive">
                    <?php
		echo '<table class="searchtable" id="sresults" >';
		echo '<thead>';
		echo '<tr><td>Book Name</td><td>Author</td><td>ISBN</td><td>Year of Publication</td><td>availability</td></tr>';
		echo '</thead>';
		echo '<tbody>';
		
		if($_POST['sort'] == '')
		{
			$sortBy = 'book_name';
		}
		else
		{
			$sortBy = $_POST['sort'];
		}
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$search_word = "%".$_POST['search']."%";
			if($_GET['search'] != null)
			{
				$search_word = "%".$_GET['search']."%";
			}
			if($_POST['filter'] == '')
			{
				/*
				$result = mysqli_query($db, "select book_name, book_author, book_ISBN, year_published, book_availability from book where book_name like '%".$_POST[search]."%' 
				union 
				select book_name, book_author, book_ISBN, year_published, book_availability from book where book_author like '%".$_POST[search]."%'
				union
				select book_name, book_author, book_ISBN, year_published, book_availability from book where book_ISBN like '%".$_POST[search]."%'
				union
				select book_name, book_author, book_ISBN, year_published, book_availability from book where year_published like '%".$_POST[search]."%' order by ".$sortBy."
				;");
				*/
				$stmt = $db->prepare("select book_name, book_author, book_ISBN, year_published, book_availability from book where book_name like ? 
				union 
				select book_name, book_author, book_ISBN, year_published, book_availability from book where book_author like ?
				union
				select book_name, book_author, book_ISBN, year_published, book_availability from book where book_ISBN like ?
				union
				select book_name, book_author, book_ISBN, year_published, book_availability from book where year_published like ? order by ".$sortBy
				);
				
				$stmt->bind_param("ssss",$search_word,$search_word,$search_word,$search_word);
				$stmt->execute();
				$stmt->store_result();
				
				
			}
			else
			{
				//$result = mysqli_query($db, bookSelect($_POST['search'],$_POST['filter'],$sortBy));
				$stmt = $db->prepare("select book_name, book_author, book_ISBN, year_published, book_availability from book where ".$_POST['filter']." like ? order by ".$sortBy);
				
				
				$stmt->bind_param("s",$search_word);
				$stmt->execute();
				
			}
			$cols = array();
			$stmt->bind_result($cols[0],$cols[1],$cols[2],$cols[3],$cols[4]);
			while ($stmt->fetch())
			{
				echo "<tr>";
				for($i=0;$i<5;$i++)
				{
					echo "<td>";
					echo (htmlentities($cols[$i]));
					echo "</td>";
				}
				
				if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
				{
					echo ("<td >");
					echo ("<button onclick='addToFaves(\"".$cols[2]."\")'>");
					//echo ("<a href='addfave.php?ISBN=".htmlentities($row[2])."'>add to favourites</a>");
					echo "Add to Favourites";
					echo "</button>";
					echo ("</td>");
				}
				echo '</tr>';
			}
			
		}
		echo '</tbody>';
		echo '</table>';
		
		
		?>
                </div>
            </div>
            <script>
                function addToFaves($tcontents) {
                    jQuery.ajax({
                        url: "addfave.php",
                        data: "ISBN=" + $tcontents,
                        type: "POST",
                        success: function() {
                            alert('Added to favourites');
                        },
                        error: function() {}
                    });
                }

            </script>
        </div>
    </div>
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
