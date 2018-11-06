<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-5
 * Time: 上午10:42
 */


session_start();
if(isset($_SESSION["username"])){
    $conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
    or die("MySQL connect error! " . mysqli_connect_error());
    $filmName = $_GET["filmName"];

    $filmQuery = "SELECT FilmId FROM Film WHERE FilmName = '$filmName'";
    $filmResult = mysqli_query($conn, $filmQuery) or die("MySQL Query Error! ".mysqli_error($conn));
    $filmIds = mysqli_fetch_all($filmResult);
    $filmIdsNum = count($filmIds);

    for($i=0; $i<$filmIdsNum; $i++){
        $filmId = $filmIds[$i][0];
        $commentQuery = "SELECT UserId, Comment FROM Comment WHERE FilmId = $filmId";
        $commentResult = mysqli_query($conn, $commentQuery) or die("MySQL Query Error! ".mysqli_error($conn));
        while($row = mysqli_fetch_array($commentResult)){
            $userId = $row['UserId'];
            $comment = $row['Comment'];

            print("<h2>Viewer: $userId</h2><h3>Comment: $comment</h3>");
            print("<hr>");
        }
    }
}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}

?>