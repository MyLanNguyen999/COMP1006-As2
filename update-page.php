<?php
$title = 'Saving Page Updates';
include('shared/header.php');

// * capture the form input from edit-page.php
$pageId = $_POST['pageId'];
$title = $_POST['title'];
$content = $_POST['content'];
$ok = true;

// * input validation
if(empty($title)) {
    echo 'Page Title is required. <br />';
    $ok = false;
}

if(empty($content)) {
    echo 'Page Content is required. <br />';
    $ok = false;
}

if ($ok == true){

    //* error handling 
    try {

        // * connect db
        include('shared/db.php');

        //* set up query to update the page info
        $sql = "UPDATE adminPages SET title = :title, content = :content WHERE pageId = :pageId";
        
        // * prepare conection
        $cmd = $db->prepare($sql);

        // * map inputs
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR, 900);

        // * execute
        $cmd->execute();

        // * disconnect
        $db = null;

        // * message on screen
        echo 'Page Updated.';
    }
    catch (exception $err) {
            header('location:error.php');
            exit();
        }
}
?>
</main>
</body>
</html>