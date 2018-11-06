
<link rel="stylesheet" type="text/css" href="history_style.css">
<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-5
 * Time: 上午11:15
 */

session_start();
if(isset($_SESSION["username"])){
    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    print("<h1>Purchase History</h1>");
    $username = $_SESSION["username"];
    print("<h3>Username: $username</h3>");

    $conn = mysqli_connect("sophia.cs.hku.hk", "xlai", "255511", "xlai")
    or die("MySQL connect error! " . mysqli_connect_error());
    $ticketsQuery = "SELECT * FROM Ticket WHERE UserId = '$username' and Valid = true";
    $ticketsResult = mysqli_query($conn, $ticketsQuery) or die("MySQL Query Error! ".mysqli_error($conn));

    if(mysqli_num_rows($ticketsResult)>0){
        while($ticketRow = mysqli_fetch_array($ticketsResult)){
            $ticketId = $ticketRow["TicketId"];
            $seatNo = $ticketRow["SeatNo"];
            $broadCastId = $ticketRow["BroadCastId"];
            $ticketFee = $ticketRow["TicketFee"];
            $ticketType = $ticketRow["TicketType"];

            $broadCastQuery = "SELECT * FROM BroadCast WHERE BroadCastId = $broadCastId";
            $broadCastResult = mysqli_query($conn, $broadCastQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            $broadCast = mysqli_fetch_array($broadCastResult);

            $date = $broadCast["Dates"]."(".$broadCast["day"].") ".$broadCast["Time"];
            $houseId = $broadCast["HouseId"];
            $filmId = $broadCast["FilmId"];

            $filmQuery = "SELECT FilmName, Language, Duration FROM Film WHERE FilmId = $filmId";
            $filmResult = mysqli_query($conn, $filmQuery) or die("MySQL Query Error! ".mysqli_error($conn));
            $film = mysqli_fetch_array($filmResult);
            $filmName = $film["FilmName"];
            $duration = $film["Duration"];
            $language = $film["Language"];

            print("<div>TicketId:$ticketId $ticketFee($ticketType)</div>");
            print("<div>House:$houseId</div>");
            print("<div>Seat:$seatNo</div>");
            print("<div>FilmName:$filmName $duration</div>");
            print("<div>Language:$language</div>");
            print("<div>Date: $date</div>");
            print("<hr>");
        }
    }

}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.html");
    exit;
}

?>