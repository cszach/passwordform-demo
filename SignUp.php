<html lang="en-US">

    <head>
        <meta charset="utf-8" />
        <title>Sign Up</title>
        <link type="text/css" rel="stylesheet" href="SignUp.css" />
        <link href="https://fonts.googleapis.com/css?family=Dosis|Fredoka+One|Open+Sans" rel="stylesheet">
        <script src='https://code.jquery.com/jquery-3.1.0.min.js'></script> <!--Import jQuery-->
        <script src="script.js"></script>
    </head>

    <body>
        <h1>Sign Up</h1>
        <span><strong>...for a PHP class!</strong></span>
        <div id="main">
            <img src="http://bit.ly/2tqM6KF" alt="programming laptop" width="600" />
            <form action="SignUp.php" method="post"> <br/>
            <input type="text" placeholder="Username" name="username" class="field" id="username" /> <br/>
            <input type="text" placeholder="E-mail" name="email" class="field" id="email" /> <br/> 
            <input type="password" placeholder="Password" name="password" class="field" id="password" /> <br/>
            <input type="password" placeholder="Confirm Password" name="cfpassword" class="field" id="cfpassword" /> <br/>
            <input type="submit" />
            </form>
        </div>
        <div id="info">
            <div id="info-button">Page info</div> <!--This is a button-->
            <div id="code-button">See code</div> <!--This is a button as well-->
            <div id="sign-in-button">Sign in</div> <!--This is the last button...-->
            <div id="site-description"> <!--Site description is hidden and is toggled by info-button-->
                Written by Duong in HTML, CSS, JavaScript, PHP. <br/>
                This site is a demo of a sign up / sign in system. <br/>
                It hashes the username with MD5, and use <br/>
                that hash as a salt to hash the password <br/>
                with SHA1.
            </div>
            <div id="contact">
                Contact: Mr. Nam a.k.a. teacher Nam: 0978088833
            </div>
            <div id="copyright-info">
                Copyleft 2017. Alright reserved.
            </div>
        </div>
    </body>

</html>

<?php
    session_start();
    function is_empty($anyString) {
        return strlen($anyString) == 0;
    }

    // This if statement gets executed if the submit button is hit at least once
    if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["cfpassword"])) {
        // Save user's input

        // Check if any of the fields in empty. If one is found empty, reload the sign up page.
        if (is_empty($_POST["username"]) || is_empty($_POST["email"])
        || is_empty($_POST["password"]) || is_empty($_POST["cfpassword"])
        ) {
            echo "<script> emptyField(); </script>"; // Create pop up to alert: empty field
            die();
        }

        if ($_POST["password"] != $_POST["cfpassword"]) {  // Password confirmation fails
            echo "<script> failConfiguration(); </script>";  // JS pop up again
            die();
        }

        // Save inputs
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["email"] = $_POST["email"];

        // Encrypt password
        $salt = md5($_POST["username"]);  // Use hashed username as salt
        $_SESSION["salt"] = $salt;
        $_SESSION["hash"] = sha1($_POST["password"].$salt);  // Hash password then store it
        header("Location: SignIn.php");  // Redirect to sign in page
    }
?>