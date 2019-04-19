
<link rel="stylesheet" type="text/css" href="confirm_style.css">
<?php

session_start();

if(isset($_SESSION["username"])){
    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    $filmInfoJsonStr = $_POST['FilmInfoJsonStr'];
    $filmInfo = json_decode($filmInfoJsonStr,true);
    $broadCastId = $_POST['BroadCastId'];
    $seatsJsonStr = $_POST['SeatsJsonStr'];
    $seats = json_decode($seatsJsonStr,true);
    $seatsNum = count($seats);
    $ticketTypes = $_POST['TicketType'];
    $ticketTypesJsonStr = json_encode($ticketTypes);
    $filmId = $filmInfo['FilmId'];

    print("<h1>Order information</h1>");

    print("<form method='post' action='buywelcome.php'>");
    print("<input type='hidden' name='SeatsJsonStr' value='$seatsJsonStr'>");
    print("<input type='hidden' name='FilmId' value=$filmId>");
    print("<input type='hidden' name='BroadCastId' value=$broadCastId>");
    print("<input type='hidden' name='TicketTypesJsonStr' value=$ticketTypesJsonStr>");

    print("<table>");
    $fee = 0;
    for($i=0; $i<$seatsNum; $i++){
        print("<tr><td>Cinema: </td><td>US Cinema</td></tr>");
        print("<tr><td>House: </td><td>".$filmInfo['HouseId']."</td></tr>");
        print("<tr><td>SeatNo: </td><td>".$seats[$i]."</td></tr>");
        print("<tr><td>Film: </td><td>".$filmInfo["FilmName"]."</td></tr>");
        print("<tr><td>Category: </td><td>".$filmInfo["Category"]."</td></tr>");
        print("<tr><td>Show Time: </td><td>".$filmInfo["ShowTime"]."</td></tr>");
        $ticketFee = "";
        if($ticketTypes[$i] == "Adult"){
            $ticketFee = "$75(".$ticketTypes[$i].")";
            $fee += 75;
        }else{
            $ticketFee = "$50(".$ticketTypes[$i].")";
            $fee += 50;
        }
        print("<tr><td>Ticket Fee: </td><td>".$ticketFee."</td></tr>");

    }
    print("</table>");
    print("<p id='fee'>Total Fee: $ ".$fee."</p>");
    print("<hr>");
    print("<p>Please present valid proof of age/status when purchasing Student or Senior tickets before entering the cinema house.</p>");
    print("<input type='submit' value='OK'>");

}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}
?>