<?php
// * add auth.php
include('shared/auth.php');

// * grab the pageId from URL by $_GET
$pageId = $_GET['pageId'];

if(is_numeric($pageId)) {
    // * error handling
    try {
        // * connect db
        include('shared/db.php');
        // * prepare sql
        $sql = "DELETE FROM adminPages WHERE pageId = :pageId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);

        // * execute sql
        $cmd->execute();

        // * disconnect
        $db = null;

        // * message user
        echo 'Page deleted';

        // * page redirect
        header('location:pages.php');
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
