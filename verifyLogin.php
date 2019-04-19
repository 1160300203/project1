<?php
//$conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")


session_start();

$conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
or die("MySQL connect error! " . mysqli_connect_error());
$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT password from User where userid = '$username'";
$result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
$row = mysqli_fetch_row($result);

if($row[0] == $password){
    session_start();
    if(!isset($_SESSION['username'])){
        $_SESSION['username'] = $username;
    }
    if($username == 0){
        header("Location: admin.html");
    }
    else{
        header("Location: main.php");
    }
    exit;
}else{
    print("<h1>Invalid login, please login again.</h1>");
    header("refresh:3; url='index.php'");
    exit;
}

?>