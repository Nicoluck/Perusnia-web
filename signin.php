<?php require './layout/headerIndex.php';
require './controller/AuthController.php';
$user = new AuthController();

if (isset($_POST["submit"])) {
  $user->signin();
}
?>
<div class="signin">
  <div class="image">
    <img src="assets/images/banner.png" alt="">
  </div>
  <div class="box-signin">
    <h3 class="signin-title">Sign In</h3>
    <?php
    if (isset($_SESSION["failed"])) {
      echo ' <div class="alert-error">
      ' . $_SESSION["failed"] . '
      </div>';
    }
    if (isset($_SESSION["success"])) {
      echo ' <div class="alert-success">
      ' . $_SESSION["success"] . '
      </div>';
    }
    ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter Your Email" oninvalid="this.setCustomValidity('Email is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter Your Password" oninvalid="this.setCustomValidity('Password is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="button-signin">
        <input type="submit" value="Sign In" name="submit" />
        <a href="signup.php">Sign Up</a>
      </div>
    </form>
  </div>

</div>

<?php
unset($_SESSION["failed"]);
unset($_SESSION["success"]);
?>

<script src="./assets/js/index.js"></script>
</body>

</html>