<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index_style.css">
</head>
<body>
<div id="div1">
<h1>US CINEMA</h1>
<form method="post" action="verifyLogin.php" onsubmit="return validateForm()">
    <p><input type="text" name="username" id="username" placeholder="Username"></p>
    <p><input type="password" name="password" id="password" placeholder="Password"></p>
    <p><input type="submit" value="SUBMIT"></p>
    <p><input type="button" value="Create an account" onclick="location.href='createaccount.html'"></p>
    <?php
        session_start();
        $_SESSION["db_host"] = "localhost";
        $_SESSION["db_user"] = "debian-sys-maint";
        $_SESSION["db_password"] = "u0kdbTu0JPf01068";
        $_SESSION["db_name"] = "project1";
    ?>
</form>
</div>
<script>
    function validateForm() {
        if(document.getElementById("username").value == "" ||
            document.getElementById("password").value == ""){
            alert("Please do not leave the fields empty");
            return false
        }
        return true;
    }

</script>
</body>
</html>