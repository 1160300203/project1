<?php
session_start();
$conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
or die("MySQL connect error! " . mysqli_connect_error());
$username = $_POST["username"];
$password = $_POST["password"];
$query = "SELECT userid from User where userid = '$username'";
$result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
if(mysqli_num_rows($result) == 0){
    $query = "INSERT INTO User (userid, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
    print("<h1>Account created! Welcome</h1>");
    header("refresh:3; url=index.php");
    exit;
}else{
    print("<h1>Account already existed</h1>");
    header("refresh:3;url=createaccount.html");
    exit;
}
?>