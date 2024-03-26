<?php
// * add auth.php
include('shared/auth.php');

// * grab the userId from URL by $_GET
$userId = $_GET['userId'];

if(is_numeric($userId)) {
    // * error handling
    try {
        // * connect db
        include('shared/db.php');
        // * prepare sql
        $sql = "DELETE FROM adminUsers WHERE userId = :userId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

        // * execute sql
        $cmd->execute();

        // * disconnect
        $db = null;

        // * message user
        echo 'User deleted';

        // * page redirect
        header('location:control-panel.php');
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
