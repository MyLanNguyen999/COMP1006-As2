    <?php 
    $title = 'Login';
    include('shared/header.php'); 
    ?>
    <main>
    <h2>Login</h2>
    <?php
    if (!empty($_GET['invalid'])) {
      echo '<h4> INVALID LOGIN </h4>';
    }
    ?>

  <h4>Please enter your credentials.</h4>
  <div class="login-form">
  <form method="post" action="validate.php">
    
      <label for="username">Username:</label>

      <input name="username" id="username" required type="email" placeholder="email@email.com" />
      </br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required  />
  </br>
    <button>Login</button>
  </form>
</div>
</main>
</body>
<?php
include('shared/footer.php');
?>
</html>