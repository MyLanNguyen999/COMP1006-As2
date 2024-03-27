<?php
// * retrieve the list of the pages
    include('shared/db.php');
    $sql = "SELECT pageId, title, content FROM adminPages";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $pages = $cmd->fetchAll();

    // * display each page in the navigation
    foreach ($pages as $page) {
        echo '<li><a href="show-page.php?pageId=' . $page['pageId'] . '">' . $page['title'] . '</a></li>';
    }

    // * disconnect
    $db = null;
?>