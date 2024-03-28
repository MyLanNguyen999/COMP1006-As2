<?php
$title = 'Admin Register';
include('shared/header.php');
?>
<main>
    <h2> Admin Registration </h2>
    <h4><em>Password must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</em></h4>

    <?php
    // * get the duplicate word from the URl and send out the message
    if (!empty($_GET['duplicate'])) {
      echo '<h4 class="err"> Username already exists </h4>';
    }
    ?>

    <!-- // * Create form for registration -->
     <div class="register-form">
    <form method="post" action="save-registration.php">
       
            <label for="firstName">First Name: *</label>
            <input name="firstName" id="firstName" required type="text" placeholder="John" />
            </br>
            <label for="lastName">Last Name: *</label>
            <input name="lastName" id="lastName" required type="text" placeholder="Doe" />
            
            </br>
            
            <label for="username">Username: *</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
            
            </br>
            
            <label for="password">Password: *</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /> <img id="showHide" src="img/show.png" alt="Show/Hide" onClick = "togglePassword();"/>
            
            </br>
            
            <label for="confirm">Confirm Password: *</label>
            <input type="password" name="confirm" id="confirm" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup = "return comparePasswords();"/> <span id="pwErr"></span>
        
            </br>

            <button> Register </button>
        
    </form>
    </div>
</main>
</body>
<?php
include('shared/footer.php');
?>
</html>