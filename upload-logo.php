<?php
$title = 'Upload Logo';
include('shared/header.php');

?>
<h2> Upload Logo </h2>
<form method="post" action="insert-logo.php" enctype="multipart/form-data">
    <label for="logo"> Choose a logo: * </label>
    <input type="file" id="logo" name="logo" accept="image/"/>
    <button> Upload </button>
</form>
</main>
</body>
</html>