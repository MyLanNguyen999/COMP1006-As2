<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/styles.css" rel="stylesheet" />
    <title><?php echo $title ?></title>
</head>
<body>
    <h1> COMP 1006 - As2 </h1>
    <ul>
        <!-- <li> 
            <a href="register.php"> Register </a>
        </li> -->
        <?php
            // * only call session start if it is not called before
            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }
        ?>
        
            <?php
            if (!empty($_SESSION['username'])) {
                echo 
                    '<li>
                        <a href="control-panel.php"> Control Panel</a>
                    </li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>

                    <li>
                        <a href="#">' . $_SESSION['username'] . '</a>
                    </li>';
             }
            else {
              echo 
                '<li>
                    <a href="register.php">Register</a>
                </li>

                <li>
                    <a href="login.php">Login</a>
                </li>';
            }
            ?>
        
        <li> 
            Page 3
        </li>
    </ul>    
<main>