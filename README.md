<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Demo/Form/Hour of Code</h1>
        <p>Simple PHP code sample for processing sign up form.</p>
        <h3>Contents</h3>
        <ol>
            <li><a href="#content-1">Virtual server</a></li>
            <li><a href="#content-2">Try it out</a></li>
            <li><a href="#content-3">How it works</a></li>
            <li><a href="#content-4">External References</a></li>
        </ol>
        <hr/>
        <h2 id="content-1">Virtual server</h2>
        <p>
            A virtual server can be created with an application. Maybe Wampp, maybe Xampp. <br/>
            Once started, the application links localhost with a specific directory on your computer, known as "root directory". <br/>
            For example, as for Xampp, the root directory on Windows is C:\xampp\htdocs, on Linux is /opt/lampp/htdocs. <br/>
            To access a file in the root directory via your web browser, you would have to type localhost, and then <br/>
            a forward slash, and then the file name. <br/> <br/>
            For instance, you have a file called "index.html" in your root directory. That is, the location of that file <br/>
            on your computer is C:\xampp\htdocs\index.html (Assuming that you use Windows). To access that file via your <br/>
            web browser, look up for: localhost/index.html <br/>
            <br/>
            Try to create a directory called "PHP" inside your root directory. Inside that "PHP" directory, create a file <br/>
            called "main.php". Now, to access that file via your web browser, you would have to look up for localhost/PHP/main.php <br/>
        </p>
        <hr/>
        <h2 id="content-2">Try it out</h2>
        <p>
            This website consists of 6 files: SignUp.php, SignUp.css, script.js, SignIn.php, SignIn.css, final.js <br/>
            Download all of those files <a href="https://github.com/nhduong0133/passwordform-demo/releases">here</a>.
            Then, start a virtual server. <br/>
            Now, under your root directory, create a folder with the name "Secure Form". <br/>
            Save the 6 files you just downloaded inside that folder (Secure Form). <br/>
            In your web browser of choice, enter this address: localhost/Secure Form/SignUp.php <br/>
            Voila! You are now in the sign up page! Try to do the following things: <br/>
            <ul>
                <li>Leave one of the fields or all of the fields empty and hit the submit button</li>
                <li>Leave no fields empty, but type in the wrong password confirmation and hit the submit button</li>
                <li>Hover the mouse cursor over the "Sign Up" at the top of the page</li>
                <li>Hover the mouse cursor over the image</li>
                <li>Click the "Page info" button</li>
            </ul>
            Once you've done all of that, try to sign up normally. (Fill out all the fields with correct password confirmation) <br/>
            It should probably take you to the sign in page, which is actually the file SignIn.php <br/>
            Now, in the sign in page, try to do the following things: <br/>
            <ul>
                <li>Leave one of the fields or all the fields empty and hit the submit button</li>
                <li>Enter the wrong password (a string that doesn't match what you've put in the password field in the sign up page)</li>
            </ul>
            Once you've experienced all of that, try to input the correct username/email and the correct password. <br/>
            It should redirect you to HourOfCode's website. ;) <br/>
        </p>
        <hr/>
        <h2 id="content-3">How it works</h2>
        <p>
            <h3>On the sign up page:</h3>
            <p>
            When you hover your mouse cursor on the submit button, its background turns to dark blue. This is done by CSS. Look at the code: <br/>
<pre>
input[type="submit"] {
    height: 45px;
    width: 130px;
    margin-left: 140px;
    margin-top: 10px;
    background-color: white;
    border: 0px;
    border-radius: 20px;
    font-size: 22px;
    font-family: Fredoka One, sans-serif;
    transition: 1s;
}</pre> <br/> <br/>
            The <code>transition</code> property at the end controls the amount of time for the button to take the effect of <br/>
            hovering the mouse cursor on it. Hovering action is listened by the pseudo class <code>hover</code>: <br/>
<pre>
input[type="submit"]:hover {
    background-color: navy;
    color: grey;
}</pre> <br/> <br/>
            When you click on the "Page info" button, the page's description rolls out. This is done by a JavaScript library called <br/> <i>jQuery</i>. Here is the code that handles this (You can find this in script.js file): <br/>
<pre>
$("#site-description").hide();
$("#info-button").on("click", function() {
    $("#site-description").slideToggle();
});
</pre> <br/> <br/>
            If you leave any of the fields blank, PHP does know that with the follow code: <br/>
<pre>
if (is_empty($_POST["username"]) || is_empty($_POST["email"])
|| is_empty($_POST["password"]) || is_empty($_POST["cfpassword"])
) {
    ...
}
</pre> <br/>
            In which the <code>is_empty()</code> function is defined earlier. It (<code>is_empty</code> function) uses <code>strlen</code> to know <br/> if the length of the input is 0. If it is, PHP calls the JavaScript function <code>emptyField()</code>. <br/>
            Here's how PHP calls a JavaScript function: <br/>
            <code>echo "&lt;script&gt; anyJSFunction(); &lt;/script&gt;"</code> <br/>
            That is actually an example of HTML in CSS. <br/> <br/>
            If you fill in all the fields, and have the password confirmation right, then when you hit the submit button, <br/>
            PHP does the hashing job. <br/>
            Usually, sites <a href="#" onclick="window.open('http://bit.ly/2umTmdA'); return false;">hash</a> passwords and save them into sessions. This site does just like that. <br/>
            It first hashes the username with MD5 function to generate a salt, and then use that salt to hash the user's password <br/> with SHA-1 function. <br/>
            The hashed password and the salt are saved into 2 sessions with PHP's <code>$_SESSION</code> method. <br/>
            The sign up page then redirects you to the sign in page with the <code>header</code> function. <br/>
            </p>
            <h3>On the sign in page:</h3>
            <p>
            The sign in page acts pretty much the same as the sign up page, only the way it deals with user's input is different. <br/>
            The sign in page takes the user's input for username/email and see if it matches with anything that is previously submitted, <br/> either username or email, that are saved in PHP's <code>$_SESSION</code>. <br/>
            It then takes the user's input for password, takes the salt (saved in <code>$_SESSION["salt"]</code>), and hash the input for <br/> password with that salt using SHA-1. The page then compares the collected hash with <code>$_SESSION["hash"]</code>. <br/>
            If either the username (or email) or the password doesn't match, PHP calls JavaScript's <code>incorrectCredential()</code> function. <br/>
            If not, it redirects to the homepage. :)
            </p>
        </p>
        <hr/>
        <h2 id="content-4">External References</h2>
        <p>
            <ol>
                <!--href="#" onclick='window.open("http://www.foracure.org.au");return false;'-->
                <li><a href="#" onclick="window.open('https://jquery.com/'); return false;">jQuery</a> (JavaScript's library)</li>
                <li>PHP's <a href="#" onclick="window.open('http://php.net/manual/en/reserved.variables.session.php'); return false;">$_SESSION</a></li>
                <li><a href="#" onclick="window.open('https://en.wikipedia.org/wiki/Cryptographic_hash_function'); return false;">Password hashing</a> (English)</li>
                <li><a href"#" onclick="window.open('https://vi.wikipedia.org/wiki/H%C3%A0m_b%C4%83m_m%E1%BA%ADt_m%C3%A3_h%E1%BB%8Dc'); return false;">Password hashing</a> (Vietnamese)</li>
                <li>PHP's <a href="#" onclick="window.open('http://php.net/manual/en/function.md5.php'); return false;">md5 function</a>, used to calculate the MD5 hash of a string</li>
                <li>PHP's <a href="#" onclick="window.open('http://php.net/manual/en/function.sha1.php'); return false;">sha1 function</a>, used to calculate the SHA-1 hash of a string</li>
            </ol>
        </p>
    </body>
</html>