<?php
$title = 'Admin Register';
include('shared/header.php');
?>
<main>
    <h2> Admin Registration </h2>
    <h5>Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</h5>

    <?php
    // * get the duplicate word from the URl and send out the message
    if (!empty($_GET['duplicate'])) {
      echo '<h4 class="err"> Username already exists </h4>';
    }
    ?>

    <!-- // * Create form for registration -->
    <form method="post" action="save-registration.php">
        <fieldset>
            <label for="username">Username: *</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>

        <fieldset>
        <label for="password">Password: *</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /> <img id="showHide" src="img/show.png" alt="Show/Hide" onClick = "togglePassword();"/>
        </fieldset>

        <fieldset>
        <label for="confirm">Confirm Password: *</label>
        <input type="password" name="confirm" id="confirm" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup = "return comparePasswords();"/> <span id="pwErr"></span>
        </fieldset>

        <button> Register </button>
    </form>
</main>
</body>
</html>