<?php
$title = 'Save Registration';
include ('shared.header.php');

//* Capture form inputs
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

//* Validate form inputs
    // * make sure it is not empty
     if (empty($firstName)) {
        echo 'First Name is required <br/>';
        $ok = false;
    }
     if (empty($lastName)) {
        echo 'Last Name is required <br/>';
        $ok = false;
    }
    if (empty($username)) {
        echo 'Username is required <br/>';
        $ok = false;
    }

    // * make sure the pw is more than 8-char long
    if (strlen(password) < 8) {
        echo '8-char password is required </br>';
        $ok = false;
    }

    if ($password != $confirm) {
        echo 'Password must match <br/>';
        $ok = false;
    }

//* Hash the pw
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// * error handling
try {
    //* Connect to DB, check for duplication and insert the value
    include('shared/db.php');
        //* Check for duplication
        $sql = "SELECT * FROM adminUsers WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd -> bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd -> execute();
        $adminUsers = $cmd->fetchAll();

        //* if username already existed, redirect to registration page
        if(!empty($adminUsers)) {
            $db = null;
            header('location:register.php?duplicate=true');
            exit();
        }

        //* Insert the value after checking
        $sql = "INSERT INTO adminUsers (username, password, firstName, lastName) VALUES (:username, :password, :firstName, :lastName)";
        $cmd = $db -> prepare($sql);
        $cmd -> bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
        $cmd -> bindParam(':firstName', $firstName, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':lastName', $lastName, PDO::PARAM_STR, 50);
        $cmd -> execute();

    //* Disconnect
    $db = null;

    //* Confirmation
    echo 'Sucessful admin registration.';
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

// * Username: monday@gc.ca, tuesday@gc.ca, wednesday@gc.ca
// * PW: Test123456

?>
</main>
</body>
</html>