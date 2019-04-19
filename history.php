
<link rel="stylesheet" type="text/css" href="history_style.css">
<?php
session_start();
if(isset($_SESSION["username"])){
    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    print("<h1>Purchase History</h1>");
    $username = $_SESSION["username"];
    print("<h3>Username: $username</h3>");

    $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
        or die("MySQL connect error! " . mysqli_connect_error());
    $ticketsQuery = "SELECT Ticketid, SeatNo, TicketType, TicketFee, Date, Time, FilmName, Duration, Language, Houseid FROM Ticket NATURAL JOIN BroadCast JOIN Film ON BroadCast.filmid = Film.Filmid AND userid = '$username'";
    $ticketsResult = mysqli_query($conn, $ticketsQuery) or die("MySQL Query Error! ".mysqli_error($conn));

    if(mysqli_num_rows($ticketsResult)>0){
        while($ticketRow = mysqli_fetch_array($ticketsResult)){
            $ticketId = $ticketRow["Ticketid"];
            $seatNo = $ticketRow["SeatNo"];
            $ticketFee = $ticketRow["TicketFee"];
            $ticketType = $ticketRow["TicketType"];
            $date = $ticketRow["Date"]." ".$ticketRow["Time"];
            $houseId = $ticketRow["Houseid"];
            $filmName = $ticketRow["FilmName"];
            $duration = $ticketRow["Duration"];
            $language = $ticketRow["Language"];

            $type = 'Student or Child';
            if($ticketType == 0){
                $type = "Adult";
            }

            print("<div>TicketId:$ticketId</div>");
            print("<div>TicketFee:$$ticketFee($type)</div>");
            print("<div>House:$houseId</div>");
            print("<div>Seat:$seatNo</div>");
            print("<div>FilmName:$filmName</div>");
            print("<div>Duration:$duration mins</div>");
            print("<div>Language:$language</div>");
            print("<div>Date: $date</div>");
            print("<hr>");
        }
    }

}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}

?>