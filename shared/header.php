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
        <!-- <h1> COMP 1006 - As2 </h1> -->
    </header>
    
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
                        <a href="index.php"> Home </a>
                    </li>
                    
                    <li>
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
                </li>
                ';
            }

            // * retrieve the list of the pages
            include('shared/db.php');
            $sql = "SELECT pageId, title FROM adminPages";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $pages = $cmd->fetchAll();

            // * display each page in the navigation
            foreach ($pages as $page) {
                echo '<li><a href="show-page.php?pageId=' . $page['pageId'] . '">' . $page['title'] . '</a></li>';
            }

        // Disconnect from the database
        $db = null;
            ?>
    </ul>    
<main>