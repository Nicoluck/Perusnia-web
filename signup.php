<?php
require './layout/headerIndex.php';
?>

<?php
if (isset($_POST["submit"])) {
  //username validation
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_verif = validation($_POST['password_verification']);

  if (!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,10}[0-9a-zA-Z]$/', $username) || $password != $password_verif) {
    if (!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,10}[0-9a-zA-Z]$/', $username)) { // \w equals "[0-9A-Za-z_]"
      $_SESSION['alert']['error'] = " username can only be letters, numbers or _ and must be preceded by a letter with a maximum length of 10 characters";
    }

    if ($password != $password_verif) {
      $_SESSION['alert']['error'] = "Password verification not match";
    }
  } else {
    if ($user->insert() > 0) {
      $_SESSION["success"] = "Berhasil Signup!, Silahkan sign in";
      header("Location: signin.php");
    } else {
      echo ' <div class="alert-error">
      Signup gagal!!
      </div>';
    }
  }
}
?>


<div class="signin">
  <div class="image">
    <img src="assets/images/banner.png" alt="">
  </div>
  <div class="box-signin">
    <h3 class="signin-title">Sign Up</h3>
    <?php
    if (isset($_SESSION['alert']['error'])) {
      echo '<div class="alert-error">
        ' . $_SESSION['alert']['error'] . '
      </div>';
    }
    ?>
    <form action="" method="post">

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Masukkan username" oninvalid="this.setCustomValidity('username is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" placeholder="Masukkan firstname" oninvalid="this.setCustomValidity('fisrtname is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" placeholder="Masukkan lastname" oninvalid="this.setCustomValidity('lastname is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group gender">
        <input type="radio" name="gender" value="laki-laki" checked /> Laki-Laki
        <input type="radio" name="gender" value="perempuan" /> perempuan
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" placeholder="Masukkan country" oninvalid="this.setCustomValidity('country is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" placeholder="Masukkan City" oninvalid="this.setCustomValidity('city is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Masukkan Password Verifikasi" oninvalid="this.setCustomValidity('email is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Masukkan Password Verifikasi" oninvalid="this.setCustomValidity('Password is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="form-group">
        <label for="password_verifivation">Password Verifikasi</label>
        <input type="password" name="password_verification" placeholder="Masukkan Password Verifikasi" oninvalid="this.setCustomValidity('password verification is required')" onchange="this.setCustomValidity('')" required />
      </div>
      <div class="button-signin">
        <input type="submit" value="Sign Up" name="submit" />
        <a href="signin.php">Sign In</a>
      </div>

    </form>
  </div>

</div>

<?php
if (isset($_SESSION['alert'])) {
  unset($_SESSION['alert']);
}
?>
<script src="./assets/js/index.js"></script>
</body>

</html>