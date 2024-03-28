<?php
// $title = 'Show Page';
// include('shared/header.php');

// * connect db
include('shared/db.php');

// * get $pageId
$pageId = $_GET['pageId'];

    // Retrieve the page information from the database based on the pageId
    $sql = "SELECT title, content FROM adminPages WHERE pageId = :pageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
    $cmd->execute();
    $page = $cmd->fetch();

    // Display the page information if found
    if ($page) {
        $title = $page['title'];
        include('shared/header.php');
        echo '<h2>' . $page['title'] . '</h2>';
        echo '<p>' . $page['content'] . '</p>';
        include('shared/footer.php');
    } else {
        include('shared/header.php');
        echo '<p>Page not found</p>';
        include('shared/footer.php');
    }


// Disconnect from the database
$db = null;
?>