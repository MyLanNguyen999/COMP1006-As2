<?php
// $title = 'Show Page';
// include('shared/header.php');

// * get $pageId
$pageId = $_GET['pageId'];

// * error handling
try {
    // * connect db
    include('shared/db.php');

        // * retrieve the page information from the database based on the pageId
        $sql = "SELECT title, content FROM adminPages WHERE pageId = :pageId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

         // Debugging output
    // var_dump($page);

        // * show content
        if ($page) {
            $title = $page['title'];
            $content = $page['content'];
            include('shared/header.php');
            echo '<h2>' . $title . '</h2>';
            echo '<div class="pageContent"><p>' . $content . '</p></div>';
            include('shared/footer.php');
        } else {
            include('shared/header.php');
            echo '<p>Page not found</p>';
            include('shared/footer.php');
        }


    // * disconnect 
    $db = null;
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>