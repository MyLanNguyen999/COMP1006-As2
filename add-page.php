<?php
// * add auth.php
include('shared/auth.php');
$title = 'Add Page';
include('shared/header.php');
?>

<h2> Add a New Page </h2>

<section class="newPage">
    <label for="pageTitle"> Title: * </label>
    <input name="pageTitle" id="pageTitle" required/>
    </br>
    <label for="pageContent"> Content: * </label>
    </br>
    <textarea name="pageContent" id="pageContent" required rows="10" cols="60"> </textarea>
</section>
