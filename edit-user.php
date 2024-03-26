<?php
// * add auth page to make the page visible to login users
include('shared/auth.php');

$title = "Edit Users";
include('shared/header.php');

// * grab the userId from the URL using $_GET
$userId = $_GET['userId'];

// * initiate vars
$username = null;
$firstName = null;
$lastName = null;

// * if userId is numeric, fetch data
if(is_numeric($userId)) {

    // * error handling
    try {
        // * connect with db
        include('shared/db.php');

        // * run query and populate the user info
        $sql = "SELECT * FROM adminUsers WHERE userId = :userId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();

        // * match the value
        $username = $user['username'];
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}


?>
<h2> Edit User </h2>
    <form method="post" action="save-registration.php">
        <fieldset>
            <label for="firstName">First Name: *</label>
            <input name="firstName" id="firstName" required value="<?php echo $firstName; ?>" />
            <label for="lastName">Last Name: *</label>
            <input name="lastName" id="lastName" required value="<?php echo $lastName; ?>"/>
        </fieldset>
        <fieldset>
            <label for="username">Username: *</label>
            <input name="username" id="username" required value="<?php echo $username; ?>" />
        </fieldset>

        <!-- <fieldset>
        <label for="password">New Password: *</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /> <img id="showHide" src="img/show.png" alt="Show/Hide" onClick = "togglePassword();"/>
        </fieldset>

        <fieldset>
        <label for="confirm">Confirm New Password: *</label>
        <input type="password" name="confirm" id="confirm" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup = "return comparePasswords();"/> <span id="pwErr"></span>
        </fieldset> -->

        <!-- //* hidden value for userId -->
        <input type="hidden" name="userId" value="<?php echo $userId; ?>"/>
        <button> Confirm</button>
    </form>
</main>
</body>
</html>