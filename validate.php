<?php
// * 1. Capture the form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// * error handling
try {
    // * 2. Connect 
    include('shared/db.php');
    $sql = "SELECT * FROM adminUsers WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // * 3. Look for this username
    if (empty($user)) {
        $db = null;
        header('location:login.php?invalid=true');
    }

    // * 4. If we find a user with this username, check the hased pw
    if (!password_verify($password, $user['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    else {
        // * login is valid, both username and hashed pw match user in db

            // * store identity in session object on we server
            session_start(); //* access the current session on the server
            $_SESSION['username'] = $username;

        $db = null;
        
        // ! need to change the page later
        header('location:index.php');

    }
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

// * 5. If invalid => go to login page, if valid => shows.php

// * 6. Disconnect
?>