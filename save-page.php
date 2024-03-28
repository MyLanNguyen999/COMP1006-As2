<?php
$title = 'Save New Page';
include('shared/header.php');

// * Capture form inputs 
$pageId = $_POST['pageId'];
$title = $_POST['title'];
$content = $_POST['content'];
$ok = true;

// * validate
if(empty($title)) {
    echo 'Title is required </br>';
    $ok = false;
}
if(empty($content)) {
    echo 'Page Content is required </br>';
    $ok = false;
}
// * error handling
try {
    // * connect db
    include('shared/db.php');
    // * check for duplication
    $sql = "SELECT * FROM adminPages WHERE pageId = :pageId";
    $cmd = $db->prepare($sql);
    $cmd -> bindParam(':pageId', $pageId, PDO::PARAM_INT);
    $cmd -> execute();
    $adminPages = $cmd->fetchAll();
    // * if pageId already exist, redirect to add-page.php for new page content
    if(!empty($adminPages)) {
        $db = null;
        header('location:add-page.php?duplicate=true');
        exit();
    }
    // * insert the content after checking
    $sql = "INSERT INTO adminPages (title, content) VALUES (:title, :content)";
    $cmd = $db -> prepare($sql);
    $cmd -> bindParam(':title', $title, PDO::PARAM_STR, 100);
    $cmd -> bindParam(':content', $content, PDO::PARAM_STR, 900);
    $cmd -> execute();
    // * disconnect db
    $db = null;
    // * confirmation on screen
    echo '<p>Your content has been saved.</p>';
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
</main>
</body>
<?php
include('shared/footer.php');
?>
</html>