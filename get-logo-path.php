<?php
session_start();

// * add auth.php
include('shared/auth.php');


// $title = 'Get Logo Path';

$logoSrcDefault = './img/logo.png';
$imgTag1 = '<img src="';
$imgTag2 = '" alt="logo" id="logo"/>';

// * retrieve $finalName from the session var
if (isset($_SESSION['finalName'])) {
    $finalName = $_SESSION['finalName'];
    $logoSrcDefault = './img/uploads/' . $finalName;
}

// $newLogo = '<img src="./img/logo.png" alt="logo" id="logo"/>';
// $defaultLogo = '<img src="'. $logoSrcDefault .'" alt="logo" id="logo"/> ';
$defaultLogo = $imgTag1.$logoSrcDefault.$imgTag2;
// $logoSrcDefault = './img/uploads/game-of-thrones.png';

echo $defaultLogo;
?>