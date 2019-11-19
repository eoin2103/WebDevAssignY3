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
    <style>
        body {
            font-family: 'Google Sans', sans-serif;
        }

        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

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

            .row.content {
                height: auto;
            }
        }

        .signup {
            text-align: center;
        }

        .signupbutton {
            padding: 15px 25px;
            font-size: 24px;
            text-align: center;
            cursor: pointer;
            outline: none;
            color: #fff;
            background-color: #555;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
            box-shadow: 0 9px #999;
        }

        .signupbutton:hover {
            background-color: #085391
        }

        .signupbutton:active {
            background-color: #042a49;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        .signupcontainer {
            margin-top: 10PX;
            position: relative;
            text-align: center;
            color: white;
        }

        .signupcentered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo {
            width: 1.5em;
        }

        #sresults {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #sresults td,
        #sresults th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #sresults tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #sresults tr:hover {
            background-color: #ddd;
        }

        #sresults th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #555;
            color: white;
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
                <a class="navbar-brand" href="#"><img src="bookbicon.png" class="logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="search.php">Catalog</a></li>
                    <li><a href="info.php">My Account</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right ">
                    <li>
                        <form method="post" class="navsearch">
                            <input type="text" name="usersearch" Placeholder="Look up books or authors" />
                            <button type="submit" value="Search" href="search.php?search=usersearch" style="background-color: #e7e7e7; color:black; border: 2px solid #e7e7e7;"><i class="fa fa-search"></i></button>
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
            <div class="col-sm-10 text-left">
                <div class="signupcontainer">
                    <img src="library.jpg" alt="bookshome" style="width: 100%">
                    <div class="signup">
                        <div class="signupcentered">
                            <button class="signupbutton">Sign Up For Free Today!</button>
                        </div>
                    </div>
                </div>
                <hr>
                <h1>About Joe's</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <hr>
            </div>
            <div class="col-sm-2 sidenav">
                <div class="well">
                    <p>ADS</p>
                </div>
                <div class="well">
                    <p>ADS</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>© 2019 Eoin and Stephen, All Rights Reserved. Contact Us:
            <a href="mailto:c17400202@mytudublin.ie?Subject=Joes-Library" target="_top" style="color: #ffffff">C17400202@mytudublin.ie</a></p>
    </footer>

</body>

</html>