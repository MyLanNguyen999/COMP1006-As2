<?php
$title = "Edit Users";
include('shared/header.php');

// * error handling
try {
    // * connect LAMP server
    include('shared/db.php');
    
    // * 

}
catch (Exception $err) {
    header('location:error.php');
    exit();
}


?>