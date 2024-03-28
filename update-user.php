<?php

$title = 'Update Current User';
include ('shared/header.php');

//* Capture form inputs
$userId = $_POST['userId'];
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
    if (strlen($password) < 8) {
        echo '8-char password is required</br>';
        $ok = false;
    }

    if ($password != $confirm) {
        echo 'Password must match <br/>';
        $ok = false;
    }

//* Hash the pw
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

if ($ok == true){
// * error handling
try {
    //* Connect to DB, check for duplication and insert the value
    include('shared/db.php');

        //* update value after checking
        $sql = "UPDATE adminUsers SET firstname = :firstName, lastName = :lastName, username = :username, password = :password WHERE userId = :userId ";
        // * prepare sql
        $cmd = $db -> prepare($sql);

        // *map the data
        $cmd -> bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd -> bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
        $cmd -> bindParam(':firstName', $firstName, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':lastName', $lastName, PDO::PARAM_STR, 50);

        // * execute
        $cmd -> execute();

        //* Disconnect
        $db = null;

    //* Confirmation
    echo '<p>Sucessful user update.</p>';
    echo '<p> <a href="admin.php"> Back to User List </a></p>';
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

// * Username: monday@gc.ca, tuesday@gc.ca, wednesday@gc.ca
// * PW: Test123456
}
include('shared/footer.php');
?>
</main>
</body>

</html>