<?php
// * add auth.php
include('shared/auth.php');

$title = "Edit Page";
include('shared/header.php');

// * grab pageId from URL by $_GET
$pageId = $_GET['pageId'];

// * initiate vars
$title = null;
$content = null;

// * if pageId is numeric, fetch data
if(is_numeric($pageId)) {

    // * error handling
    try {
        // * connect with db
        include('shared/db.php');

        // * run query and populate the page info
        $sql = "SELECT * FROM adminPages WHERE pageId = :pageId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

        // * match the value
        $title = $page['title'];
        $content = $content['content'];
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
<h2> Edit Page </h2>

<section class="edit-page-form">
    <form method="post" action="update-page.php">
        <label for="title"> Title: * </label>
        <input name="title" id="title" required value="<?php echo $title; ?>"/>
        </br>
        <label for="content"> Content: * </label>
        </br>
        <textarea name="content" id="content" required rows="10" cols="60"> 
            <?php echo $page['content']; ?> 
        </textarea>
        <!-- //* hidden value for pageId -->
        <input type="hidden" name="pageId" value="<?php echo $pageId; ?>"/>
        </br>
        <button> Save Content </button>
</form>

</section>