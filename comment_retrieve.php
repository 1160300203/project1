<?php

session_start();
if(isset($_SESSION["username"])){
    $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
        or die("MySQL connect error! " . mysqli_connect_error());
    $filmName = $_GET["filmName"];

    $CommentsQuery = "SELECT userid, Comment FROM Comment WHERE filmid in (SELECT Filmid FROM Film WHERE FilmName = \"$filmName\")";

    $CommentsResult = mysqli_query($conn, $CommentsQuery) or die("MySQL Query Error! ".mysqli_error($conn));
    $Comments = mysqli_fetch_all($CommentsResult);
    $CommentsNum = count($Comments);

    for($i=0; $i<$CommentsNum; $i++){
        $userid = $Comments[$i][0];
        $comment = $Comments[$i][1];
        print("<h2>Viewer: $userid</h2><h3>Comment: $comment</h3>");
        print("<hr>");
    }
}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}

?>