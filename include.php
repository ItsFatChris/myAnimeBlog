<?php
//session variables and data
//check the valid session
session_start();

//Run once at application init
if( !isset($_SESSION["init"]) ) {
    
    // Starting session
    $_SESSION["init"] = true;
    
    // Storing session data
    $_SESSION["username"] = "";
    $_SESSION["userID"] = "";
    $_SESSION["loggedIn"] = true;
    

}


?>