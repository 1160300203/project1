<?php

session_start();
if(isset($_SESSION["username"])){
    $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
        or die("MySQL connect error! " . mysqli_connect_error());
    $filmId = $_POST["FilmId"];
    $userId = $_SESSION["username"];
    $comment = $_POST["Comment"];

    $query = "INSERT INTO Comment(filmid, userid, Comment) VALUES ($filmId, $userId, \"$comment\")";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
    print("<h1>Your comment has been submitted</h1>");
    header("refresh:3; url=comment.php");
    exit;

}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}

?>