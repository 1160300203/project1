<link rel="stylesheet" type="text/css" href="seatplantry.css">

<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-4
 * Time: 上午10:39
 */

session_start();
if(isset($_SESSION["username"])){
    $conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
    or die("MySQL connect error! " . mysqli_connect_error());
    $broadCastId = $_POST["BroadCastId"];
    $query = "SELECT * FROM BroadCast WHERE BroadCastId = '$broadCastId'";
    $result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $filmId = $row['FilmId'];
    $filmIdQuery = "SELECT * FROM Film WHERE FilmId = '$filmId'";
    $filmIdResult = mysqli_query($conn, $filmIdQuery);
    $film = mysqli_fetch_array($filmIdResult);

    $houseId = $row["HouseId"];
    $filmName = $film["FilmName"];
    $category = $film["Category"];
    $showTime = $row["Dates"]." (".$row["day"].") ".$row["Time"];
    $filmInfo = Array('HouseId'=>$houseId, 'FilmName'=>$filmName, 'Category'=>$category, 'ShowTime'=>$showTime);
    $filmInfoJsonStr = json_encode((object)$filmInfo);

    print("<h1>Ticketing</h1>");
    print("<table><tr><td>Cinema: </td><td>US</td></tr>");
    print("<tr><td>House: </td><td>$houseId</td></tr>");
    print("<tr><td>Film: </td><td>$filmName</td></tr>");
    print("<tr><td>Category: </td><td>$category</td></tr>");
    print("<tr><td>Show Time: </td><td>$showTime</td></tr></table>");

    $unavailSeatsQuery = "SELECT SeatNo FROM Ticket WHERE Valid = true";
    $unavailSeatsResult = mysqli_query($conn, $unavailSeatsQuery);
    $unavailSeats = mysqli_fetch_all($unavailSeatsResult);
    $unavailSeatsNum = count($unavailSeats);
    $unavailSeatsHashTable = array();
    for($i=0; $i<$unavailSeatsNum; $i++){
        $unavailSeatsHashTable[$unavailSeats[$i][0]] = true;
    }

    $houseQuery = "SELECT HouseRow, HouseCol FROM House WHERE HouseId = '$houseId'";
    $houseResult = mysqli_query($conn, $houseQuery) or die("MySQL Query Error! ".mysqli_error($conn));
    $house = mysqli_fetch_array($houseResult);
    $houseRow = intval($house["HouseRow"]);
    $houseCol = intval($house["HouseCol"]);

    print("<form method='post' action='buyticket.php'>");
    print("<input type='hidden' name='FilmInfoJsonStr' value='$filmInfoJsonStr'>");

    print("<table id='seat'>");
    for($i=$houseRow; $i>0; $i--){
        print("<tr class='seatRow'>");
        for($j=$houseCol; $j>0; $j--){
            $seatNo = chr($i+ord('A')-1)."".$j;
            if($unavailSeatsHashTable[$seatNo] == true){
                print("<td class='seatCellSold'>");
                print("Sold<br>".$seatNo);
            }else{
                print("<td class='seatCell'>");
                print("<input type='checkbox' name='seatNo[]' value=$seatNo>");
                print("<br>$seatNo");
            }
            print("</td>");
        }
        print("</tr>");
    }
    print("<tr id='screen'><td colspan=$houseCol>SCREEN</td></tr>");
    print("</table>");
    print("<input type='hidden' name='BroadCastId' value=$broadCastId>");
    print("<div><input type='submit' value='Submit'>");
    print("<input type='button' onclick=\"location.href='buywelcome.php'\" value='Cancel'></div>");
    print("</form>");
}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}


?>