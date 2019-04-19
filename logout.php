<?php

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), "", time()-3600);
}
session_destroy();
print("Logging out");
header("refresh:3;url=index.php");

?>