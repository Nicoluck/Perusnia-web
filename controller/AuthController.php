<?php
require_once('./koneksi/koneksi.php');
require_once('./root/base_url.php');
class AuthController
{
  function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    global $conn;
  }

  function signin()
  {
    $email = $_POST["email"];
    $password = $_POST["password"];

    function cek_data($email, $pass)
    {
      global $conn;

      $query = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $query);
      $data = mysqli_fetch_assoc($result);

      if ($data == null) {
        return false;
      }

      $userPass = $data["password"];
      $password = $pass;

      if (password_verify($password, $userPass)) {
        return $data;
      } else {
        return false;
      }
    }

    $cek = cek_data($email, $password);

    if ($cek != false) {

      $_SESSION['userdata'] = [
        "is-login" => true,
        "id_users" => $cek['id_users'],
        "id_level" => $cek["id_level"]

      ];
      if ($cek['id_level'] == 1) {
        header("Location: dashboard_admin.php");
      } else {
        header("Location: book.php");
      }
    } else {
      $_SESSION['failed'] = "Email atau password salah!";
    }
  }

  function signout()
  {
    session_destroy();
    header("Location: index.php");
  }
}
