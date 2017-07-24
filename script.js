function emptyField() {
    alert("Please fill out all the fields.");
    die(0);
}

function failConfiguration() {
    alert("Passwords do not match.");
    die(0);
}

function main() {
    $("#site-description").hide();
    $("#info-button").on("click", function() {
        $("#site-description").slideToggle();
    });
    /*
    $("#code-button").on("click", function() {
        window.location.replace("https://github.com/nhduong0133/passwordform-demo");
    });
    */
    $("#sign-in-button").on("click", function() {
        if (confirm("Are you sure you have an account already?") == true) {
            setTimeout(function () {
                window.location.replace("SignIn.php");
            }, 2000);
        }
    });
}

$(document).ready(main);