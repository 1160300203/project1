
<link rel="stylesheet" type="text/css" href="buywelcome_style.css">
<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-3
 * Time: 下午2:19
 */

session_start();
if(isset($_SESSION["username"])) {

    $conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
        or die("MySQL connect error! " . mysqli_connect_error());
    $query = "SELECT * FROM Film";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! " . mysqli_error($conn));

    if(isset($_POST["SeatsJsonStr"]) && isset($_POST["BroadCastId"]) && isset($_POST["TicketTypesJsonStr"])){
        $seats = json_decode($_POST["SeatsJsonStr"],true);
        $broadCastId = $_POST["BroadCastId"];
        $ticketTypes = json_decode($_POST["TicketTypesJsonStr"],true);

        $seatsNum = count($seats);
        $username = $_SESSION["username"];
        for($i=0; $i<$seatsNum; $i++){
            $ticketType = $ticketTypes[$i];
            $ticketFee = 0;
            if($ticketType == "Adult"){
                $ticketFee = 75;
            }else{
                $ticketFee = 50;
            }
            $ticketQuery = "INSERT INTO Ticket (SeatNo, BroadCastId, Valid, UserId, TicketType, TicketFee)
                  VALUES (\"$seats[$i]\", $broadCastId, true, \"$username\", \"$ticketTypes[$i]\", \"$ticketFee\")";

            $ticketResult = mysqli_query($conn, $ticketQuery) or die("MySQL Query Error! ".mysqli_error($conn));
        }
    }

    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $filmPoster = $row['FilmPoster'];
            $imgSrc = "images/$filmPoster";
            print("<h1>" . $row["FilmName"] . "</h1>");
            print("<p><img src=$imgSrc></p>");
            print("<h3>Synopsis: " . $row["Description"] . "</h3>");
            print("<h4>Director: " . $row["Director"] . "</h4>");
            print("<h4>Duration: " . $row["Duration"] . "</h4>");
            print("<h4>Category: " . $row["Category"] . "</h4>");
            print("<h4>Language: " . $row["Language"] . "</h4>");

            $broadCastQuery = "SELECT * FROM BroadCast";
            $broadCastResult = mysqli_query($conn, $broadCastQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            if(mysqli_num_rows($broadCastResult)>0){
                print("<form method='post' action='seatplantry.php'><select name='BroadCastId'>");
                while($broadCastRow = mysqli_fetch_array($broadCastResult)){
                    $broadCastId = $broadCastRow['BroadCastId'];
                    print("<option value=$broadCastId>".$broadCastRow["Dates"]." ".$broadCastRow["Time"]." (".$broadCastRow["day"].") House ".$broadCastRow["HouseId"]."</option>");
                }
                print("</select><input type='submit' value='Submit'></form>");
            }
            print("<hr>");
        }
    }
}else {
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}
?>