
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="main_style.css">
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-3
 * Time: 下午2:01
 */

session_start();
if(isset($_SESSION["username"])){
    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");
}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}

?>
</body>
</html>
