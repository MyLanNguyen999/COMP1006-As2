<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/styles.css" rel="stylesheet" />
    <script src="./js/script.js" defer> </script>
    <title><?php echo $title ?></title>
</head>
<body>
    <header>

        <?php
        include('./get-logo-path.php');
        ?>
    
        <ul>
            <?php
                // * only call session start if it is not called before
                if (session_status() == PHP_SESSION_NONE) {
                session_start();
                }
            ?>
            
            <?php
            echo '<div class="nav-bar">';
            if (!empty($_SESSION['username'])) {
                echo 
                    '<li>
                        <a href="index.php"> Home </a>
                    </li>
                    
                    <li>
                        <a href="control-panel.php"> Control Panel</a>
                    </li>';

                    include ('list-page.php');

                echo '<li>
                        <a href="logout.php">Logout</a>
                    </li>

                    <li>
                        <a href="#">' . $_SESSION['username'] . '</a>
                    </li>';
            }
            else {
                echo 
                    '<li>
                            <a href="index.php"> Home </a>
                    </li>';

                include ('list-page.php');
                
                echo '<li>
                    <a href="register.php">Register</a>
                    </li>

                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    ';
            }
            echo '</div>';
            ?>
        </ul> 
    </header>   
<main>