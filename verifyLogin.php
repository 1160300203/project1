<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-3
 * Time: 上午10:59
 */
$conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
or die("MySQL connect error! " . mysqli_connect_error());
$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT PW from Login where UserId = '$username'";
$result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
$row = mysqli_fetch_row($result);

if($row[0] == $password){
    session_start();
    if(!isset($_SESSION['username'])){
        $_SESSION['username'] = $username;
    }
    header("Location: main.php");
    exit;
}else{
    print("<h1>Invalid login, please login again.</h1>");
    header("refresh:3; url='index.html'");
    exit;
}

?>