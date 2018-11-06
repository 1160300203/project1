<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-3
 * Time: 下午12:09
 */
$conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
or die("MySQL connect error! " . mysqli_connect_error());
$username = $_POST["username"];
$password = $_POST["password"];
$query = "SELECT UserId from Login where UserId = '$username'";
$result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
if(mysqli_num_rows($result) == 0){
    $query = "INSERT INTO Login (UserId, PW) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
    print("<h1>Account created! Welcome</h1>");
    header("refresh:3; url=index.html");
    exit;
}else{
    print("<h1>Account already existed</h1>");
    header("refresh:3;url=createaccount.html");
    exit;
}
?>