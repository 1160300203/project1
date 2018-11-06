
<link rel="stylesheet" type="text/css" href="buyticket_style.css">
<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-4
 * Time: 上午10:39
 */

session_start();
if(isset($_SESSION["username"])){

    $filmInfoJsonStr = $_POST["FilmInfoJsonStr"];
    $filmInfo = json_decode($filmInfoJsonStr, true);

    print("<h1>Cart</h1>");
    print("<table><tr><td>Cinema: </td><td>US</td></tr>");
    print("<tr><td>House: </td><td>".$filmInfo["HouseId"]."</td></tr>");
    print("<tr><td>Film: </td><td>".$filmInfo["FilmName"]."</td></tr>");
    print("<tr><td>Category: </td><td>".$filmInfo["Category"]."</td></tr>");
    print("<tr><td>Show Time: </td><td>".$filmInfo["ShowTime"]."</td></tr></table>");

    $seats = $_POST["seatNo"];
    $seatsNum = count($seats);
    $seatsJsonStr = json_encode($seats);

    $broadCastId = $_POST["BroadCastId"];

    print("<form method='post' action='confirm.php'>");
    print("<input type='hidden' name='FilmInfoJsonStr' value='$filmInfoJsonStr'>");
    print("<input type='hidden' name='SeatsJsonStr' value='$seatsJsonStr'>");
    print("<input type='hidden' name='BroadCastId' value='$broadCastId'>");

    for($i=0; $i<$seatsNum; $i++){
        print("<p>$seats[$i]");
        print("<select name='TicketType[]'>");
        print("<option value='Adult' selected='selected'>Adult($75)</option>");
        print("<option value='Student/Senior'>Student/Senior($50)</option>");
        print("</select></p>");
    }

    print("<input type='submit' value='Confirm'>");
    print("<input type='button' value='Cancel' onclick=\"location.href='buywelcome.php'\">");

}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}


?>