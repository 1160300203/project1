
<link rel="stylesheet" type="text/css" href="comment_style.css">

<?php

session_start();
if(isset($_SESSION["username"])){
    print("<a href='buywelcome.php'> Buy A Ticket </a>");
    print("<a href='comment.php'> Movie Review </a>");
    print("<a href='history.php'> Purchase History </a>");
    print("<a href='logout.php'> Logout </a>");

    $conn = mysqli_connect($_SESSION["db_host"], $_SESSION["db_user"], $_SESSION["db_password"], $_SESSION["db_name"])
        or die("MySQL connect error! " . mysqli_connect_error());
    $username = $_SESSION["username"];
    $query = "SELECT Film.Filmid, FilmName FROM HaveWatched JOIN Film ON HaveWatched.filmid = Film.Filmid AND userid = '$username'";

    $result = mysqli_query($conn, $query) or die("MySQL Query Error! ".mysqli_error($conn));
    $filmIds = array();
    $filmNames = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $filmIds[] = $row['Filmid'];
            $filmNames[] = $row['FilmName'];
        }
    }
    print("<form method='post' action='comment_submit.php' onsubmit='return validateComment();'>");
    print("<p>Film Name:<select name='FilmId'>");
    $filmIdsNum = count($filmIds);
    for($i=0; $i<$filmIdsNum; $i++){
        $filmId = $filmIds[$i];
        print("<option value=$filmId>");
        $filmName = $filmNames[$i];
        print($filmName);
        print("</option>");
    }
    print("</select></p>");
    print("<textarea name='Comment' cols='80' rows='20' placeholder='Please input comment here. No More Than 200 Characters.' id='Comment'></textarea>");
    print("<br><input type='button' value='View comment' id='ViewComment'>");
    print("<input type='submit' value='Submit comment'>");
    print("<div id='OthersComments'></div>");
    print("</br></form>");
}else{
    print("<h1>You have not logged in</h1>");
    header("refresh:3; url=index.php");
    exit;
}
?>
<script>

    function viewComment(){
        var xmlhttp;
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById("OthersComments").innerHTML = xmlhttp.responseText;
            }
        };

        var ele = document.querySelector("option:checked");

        xmlhttp.open("GET","comment_retrieve.php?filmName="+ele.innerHTML, true);
        xmlhttp.send();
    }

    function validateComment(){
        if(document.getElementById("Comment").value==""){
            alert("You should enter the comment before the submission.");
            return false;
        }
    }

    document.getElementById("ViewComment").addEventListener("click",viewComment);

</script>
