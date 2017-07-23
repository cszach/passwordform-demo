<html lang="en-US">

    <head>
        <meta charset="utf-8" />
        <title>Sign In</title>
        <link type="text/css" rel="stylesheet" href="SignIn.css" />
        <link href="https://fonts.googleapis.com/css?family=Dosis|Fredoka+One|Open+Sans" rel="stylesheet">
        <script src='https://code.jquery.com/jquery-3.1.0.min.js'></script> <!--Import jQuery-->
        <script src="final.js"></script>
    </head>

    <body>
        <h1>Sign In</h1>
        <form action="SignIn.php" method="post">
        <input type="text" placeholder="Username or Email" name="identity" class="field" id="identity" /> <br/>
        <input type="password" placeholder="Password" name="key" class="field" id="key" /> <br/>
        <input type="submit" />
        </form>
        <a href="SignUp.php" target="_self">I don't have an account</a>
    </body>

</html>

<?php
    session_start();
    if (isset($_POST["identity"], $_POST["key"])) {

        // One of the field is empty
        if (strlen($_POST["identity"]) == 0 || strlen($_POST["key"]) == 0) {
            echo "<script> emptyField(); </script>";
            die();
        }

        // Incorrect username/email or password
        $salt = $_SESSION["salt"];
        if (($_POST["identity"] != $_SESSION["username"] && $_POST["identity"] != $_SESSION["email"])
        || sha1($_POST["key"].$salt) != $_SESSION["hash"]) {
            echo "<script> incorrectCredential(); </script>";
            die();
        }

        // Below code gets executed if everything is valid
        header("Location: http://hourofcode.vn/trung-tam-day-lap-trinh-cho-tre-em/");
        die();
    }
?>