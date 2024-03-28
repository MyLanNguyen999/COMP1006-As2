<?php
// * add auth.php
include('shared/auth.php');
$title = 'Add Page';
include('shared/header.php');
?>

<h2> Add a New Page </h2>

<section class="newPage">
    <form method="post" action="save-page.php">
        <label for="title"> Title: * </label>
        <input name="title" id="title" required/>
        </br>
        <label for="content"> Content: * </label>
        </br>
        <textarea name="content" id="content" required rows="10" cols="60"> </textarea>
        </br>
        <button> Save Content </button>
    </form>
</section>
<?php
include('shared/footer.php');
?>
