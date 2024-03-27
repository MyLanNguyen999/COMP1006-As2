<?php
session_start();
// * add auth.php
include('shared/auth.php');

$title = 'Saving New Logo';
include('shared/header.php');

// * initiate new var for new logo saves status
$newLogoSaved = false;

// * process logo
if(($_FILES['logo']['size'] > 0)) {
    $logoName = $_FILES['logo']['name'];
    $finalName = session_id(). '-' . $logoName;
    // echo $finalName .' <br/>';

    // * file size
    // $size = $_FILES['logo']['size'];

    // * temp location on server
    $tmp_name = $_FILES['logo']['tmp_name'];

    // * file type
    $type = mime_content_type($tmp_name);

    // * check if the file is png/jpeg
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Logo must be a .jpg or .png';
    }
    else {
        // * save the new logo under folder "uploads"
        // move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
        if(move_uploaded_file($_FILES['logo']['tmp_name'], 'img/uploads/' . $finalName)) {
        $newLogoSaved = true;

        // * store $finalName in a session var
        $_SESSION['finalName'] = $finalName;

        // $newLogo = '<img src="./img/uploads/'.$finalName.'" alt="logo" id="logo">';
        // echo $newLogo;
        }
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
    echo '</br> New Logo Saved';
    // echo '<img src="./img/uploads/'.$finalName.'" alt="logo" id="logo">';
    // $newLogo = '<img src="./img/uploads/'.$finalName.'" alt="logo" id="logo">';
    // echo '</br> <a href="control-panel.php"/> Control Panel </a> </br>';
    // echo $newLogo;
}
catch (exception $err) {
    header('location:error.php');
    exit();
}

?>
