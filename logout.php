<?php
/**
 * Created by PhpStorm.
 * User: xinlai
 * Date: 18-11-5
 * Time: 下午12:20
 */

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), "", time()-3600);
}
session_unset();
session_destroy();
print("Logging out");
header("refresh:3;url=index.html");

?>