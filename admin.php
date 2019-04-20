<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 19-4-19
 * Time: 下午11:53
 */
    session_start();
    if(isset($_SESSION["username"]) and $_SESSION["username"] == 0){
        $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
            or die("MySQL connect error! " . mysqli_connect_error());
        if($_POST['type'] == 'add_film'){
            $filmname = $_POST["filmname"];
            $duration = $_POST["duration"];
            $category = $_POST["category"];
            $language = $_POST["language"];
            $director = $_POST["director"];
            $filmQuery = "INSERT INTO Film (FilmName, Duration, Category, Language, Director) VALUES ('$filmname', \"$duration\", \"$category\", '$language', '$director')";
            $filmResult = mysqli_query($conn, $filmQuery) or die("MySQL Query Error! ".mysqli_error($conn));

            $filmQuery = "SELECT Filmid FROM Film WHERE FilmName = '$filmname'";
            $filmResult = mysqli_query($conn, $filmQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            $filmid = mysqli_fetch_array($filmResult)['Filmid'];

            $dates = $_POST["dates"];
            $times = $_POST["times"];
            $houseids = $_POST["houseids"];
            for($i = 0; $i < count(dates); $i++){
                $broadcastQuery = "INSERT INTO BroadCast (Date, Time, Houseid, filmid) VALUES ('$dates[$i]', '$times[$i]', '$houseids[$i]', '$filmid')";
                $filmResult = mysqli_query($conn, $broadcastQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            }
        }elseif($_POST['type'] == 'add_house'){
            $row = $_POST["houserow"];
            $col = $_POST["housecol"];
            $houseQuery = "INSERT INTO House (HouseRow, HouseCol) VALUES ('$row', '$col')";
            $houseResult = mysqli_query($conn, $houseQuery) or die("MySQL Query Error! ".mysqli_error($conn));
        }elseif($_POST['type'] == 'del_film'){
            $filmname = $_POST['filmname'];
            $BroadCastQuery = "DELETE FROM BroadCast WHERE filmid in (SELECT Filmid FROM Film WHERE FilmName = '$filmname')";
            //print($BroadCastQuery);
            $broadcastResult = mysqli_query($conn, $BroadCastQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            $filmQuery = "DELETE FROM Film WHERE FilmName = '$filmname'";
            //print($filmQuery);
            $filmResult = mysqli_query($conn, $filmQuery) or die("MySQL Query Error! ".mysqli_error($conn));
        }
        header("refresh:3; url=admin.html");
        exit;
    }
    else{
        print("<h1>You are not administrator</h1>");
        header("refresh:3; url=logout.php");
        exit;
    }
?>