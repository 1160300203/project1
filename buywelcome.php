
<link rel="stylesheet" type="text/css" href="buywelcome_style.css">
<?php
session_start();
if(isset($_SESSION["username"])) {

    $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
        or die("MySQL connect error! " . mysqli_connect_error());
    $query = "SELECT FilmName, Duration, Category, Language, Director, Date, Time, BroadCast.filmid, Houseid, BroadCastId FROM Film JOIN BroadCast on Film.Filmid = BroadCast.filmid";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! " . mysqli_error($conn));

    if(isset($_POST["SeatsJsonStr"]) && isset($_POST["BroadCastId"]) && isset($_POST["TicketTypesJsonStr"])){
        $seats = json_decode($_POST["SeatsJsonStr"],true);
        $broadCastId = $_POST["BroadCastId"];
        $filmId = $_POST["FilmId"];
        $ticketTypes = json_decode($_POST["TicketTypesJsonStr"],true);

        $seatsNum = count($seats);
        $username = $_SESSION["username"];
        for($i=0; $i<$seatsNum; $i++){
            $ticketType = $ticketTypes[$i];
            $ticketFee = 0;
            if($ticketType == "Adult"){
                $ticketFee = 75;
                $type = 0;
            }else{
                $ticketFee = 50;
                $type = 1;
            }
            $ticketQuery = "INSERT INTO Ticket (SeatNo, BroadCastId, userid, TicketType, TicketFee)
                  VALUES (\"$seats[$i]\", $broadCastId, \"$username\", \"$type\", \"$ticketFee\")";

            $ticketResult = mysqli_query($conn, $ticketQuery) or die("MySQL Query Error! ".mysqli_error($conn));

            $HaveWatchedCheckQuery = "SELECT * FROM HaveWatched WHERE userid = '$username' and filmid = '$filmId'";
            $HaveWatchedCheckResult = mysqli_query($conn, $HaveWatchedCheckQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            if(mysqli_num_rows($HaveWatchedCheckResult)==0){
                $HaveWatchedQuery = "INSERT INTO HaveWatched (userid, filmid) VALUES (\"$username\",\"$filmId\")";
                $HaveWatchedResult = mysqli_query($conn, $HaveWatchedQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            }
        }
    }

    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    if (mysqli_num_rows($result) > 0) {
        $filmid_to_broadcasts = array();
        $films = array();
        while ($row = mysqli_fetch_array($result)) {
            $filmid = $row['filmid'];
            if(!isset($filmid_to_broadcasts[$filmid])){
                $filmid_to_broadcasts[$filmid] = [];
                $films[] = [$row['FilmName'],$row['Duration'],$row['Category'],$row['Language'], $row['Director']];
            }
            $filmid_to_broadcasts[$filmid][] = [$row['Date'],$row['Time'],$row['Houseid'],$row['BroadCastId']];
        }
    }
    $i = 0;
    foreach($filmid_to_broadcasts as $key => $value){
        $row = $films[$i];
        $filmId = $key;
        //$filmPoster = $row['FilmPoster'];
        //$imgSrc = "images/$filmPoster";
        $filmName = $row[0];
        $category = $row[2];
        print("<h1>" . $filmName . "</h1>");
        //print("<p><img src=$imgSrc></p>");
        //print("<h3>Synopsis: " . $row["Description"] . "</h3>");
        print("<h4>Director: " . $row[4] . "</h4>");
        print("<h4>Duration: " . $row[1] . "</h4>");
        print("<h4>Category: " . $category . "</h4>");
        print("<h4>Language: " . $row[3] . "</h4>");
        if(count($value) > 0){
            print("<form method='post' action='seatplantry.php'><select name='FilmInfoJsonStr'>");
            foreach($value as $v){
                $broadCastId = $v[3];
                $houseId = $v[2];
                $showTime = $v[0]." ".$v[1];
                $filmInfo = Array('HouseId'=>$houseId, 'FilmName'=>$filmName, 'Category'=>$category, 'ShowTime'=>$showTime, 'FilmId'=>$filmId, "BroadCastId"=>$broadCastId);
                $filmInfoJsonStr = json_encode((object)$filmInfo);
                print("<option value='$filmInfoJsonStr'>".$showTime." House ".$houseId."</option>");
            }
            print("</select><input type='submit' value='Submit'></form>");
        }
        print("<hr>");
    }
}else {
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}
?>