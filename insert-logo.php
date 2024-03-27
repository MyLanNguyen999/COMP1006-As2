<?php
// * add auth.php
include('shared/auth.php');

$title = 'Saving New Logo';
include('shared/header.php');

// * process logo
if(($_FILES['logo']['size'] > 0)) {
    $logoName = $_FILES['logo']['name'];
    $finalName = session_id(). '-' . $logoName;

    // * file size
    $size = $_FILES['logo']['size'];

    // * temp location on server
    $tmp_name = $_FILES['logo']['tmp_name'];

    // * file type
    $type = mime_content_type($tmp_name);

    // * check if the file is png/jpeg
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Logo must be a .jpg or .png';
    }
    else {
        // * create a new folder and save the new logo
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
}

// * capture the form input from upload-logo.php
$logo = $_FILES['logo'];

// * error handling
try {
    // * connect db
    include('shared/db.php');

    // * set up query
    $sql = "INSERT INTO adminLogos (logo) VALUES (:logo)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':logo', $finalName, PDO::PARAM_STR, 100);
    $cmd->execute();

    // * disconnect db
    $db = null;

    // * message on screen
    echo 'New Logo Saved';
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
</main>
</body>
</html>