<?php
require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class userController
{
  function __construct()
  {
    global $conn;
    if (!isset($_SESSION)) {
      session_start();
    }

    function validation($data)
    {
      $data = trim($data);
      $data = preg_replace('/\s+/', ' ', $data);
      $data = htmlspecialchars($data);
      return $data;
    }
  }

  function getUsers()
  {
    global $conn;
    $query = "SELECT *,level.name as nama_level FROM users JOIN level ON level.id_level=users.id_level JOIN user_detile ON user_detile.id_user_detile=users.id_user_detile";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

  function getUserById($id_users)
  {
    global $conn;
    $query = "SELECT * FROM users where id_users=$id_users";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);

    return $res;
  }

  function insert()
  {
    global $conn;

    $username = validation($_POST['username']);
    $nama_depan = validation($_POST['firstname']);
    $nama_belakang = validation($_POST['lastname']);
    $jenis_kelamin = validation($_POST['gender']);
    $negara = validation($_POST['country']);
    $kota = validation($_POST['city']);
    $email = validation($_POST['email']);
    $password = validation($_POST['password']);
    $password_verif = validation($_POST['password_verification']);

    //input required check
    if (!$username || !$email || !$password || !$email || !$nama_depan || !$nama_belakang || !$jenis_kelamin || !$negara || !$kota || !$password_verif) {
      return false;
    }

    //password check
    if ($password != $password_verif) {
      return false;
    }

    //username validation
    if (!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,10}[0-9a-zA-Z]$/', $username)) { // \w equals "[0-9A-Za-z_]"
      return false;
    }

    $password_hash = password_hash($password_verif, PASSWORD_BCRYPT);


    $query = "INSERT INTO users (username,email,password,nama_depan,nama_belakang,jenis_kelamin,negara,kota) VALUES ('$username','$email','$password_hash','$nama_depan','$nama_belakang','$jenis_kelamin','$negara','$kota')";
    mysqli_query($conn, $query);


    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }
  // untuk crud setting account
  function update($id_user)
  {

    global $conn;
    $filename = $username = $email = $password = $email = $password = $nama_depan = $nama_belakang = $tgl_lahir = $jenis_kelamin = $no_telp = $alamat = $negara = $kota = "";
    $err = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['username'])) {
        $username = validation($_POST['username']);
      }
      if (isset($_POST['email'])) {
        $email = validation($_POST['email']);
      }
      if (isset($_POST['password'])) {
        $password = password_hash(validation($_POST['password']), PASSWORD_BCRYPT);
      }
      if (isset($_POST['nama_depan'])) {
        $nama_depan = validation($_POST['nama_depan']);
      }
      if (isset($_POST['nama_belakang'])) {
        $nama_belakang = validation($_POST['nama_belakang']);
      }
      if (isset($_POST['tgl_lahir'])) {
        $tgl_lahir = validation($_POST['tgl_lahir']);
      }
      if (isset($_POST['jenis_kelamin'])) {
        $jenis_kelamin = validation($_POST['jenis_kelamin']);
      }
      if (isset($_POST['no_telp'])) {
        $no_telp = validation($_POST['no_telp']);
      }
      if (isset($_POST['alamat'])) {
        $alamat = validation($_POST['alamat']);
      }
      if (isset($_POST['negara'])) {
        $negara = validation($_POST['negara']);
      }
      if (isset($_POST['kota'])) {
        $kota = validation($_POST['kota']);
      }
    } else {
      return false;
    }

    if (!$username || !$email || !$password || !$email || !$password || !$nama_depan || !$nama_belakang || !$jenis_kelamin || !$negara || !$kota) {
      return false;
    }

    //send spesific error message
    // if ($err) {
    //   echo json_encode([
    //     "status" => 400,
    //     "message" => $err
    //   ]);
    //   return false;
    // }

    //username validation
    if (isset($_POST['username'])) {
      if (!preg_match('/^\w{5,}$/', $username)) { // \w equals "[0-9A-Za-z_]"
        return false;
      }
    }


    //upload file
    if (isset($_FILES['foto'])) {

      $foto = $_FILES['foto'];
      $ekstensiValid = ['jpg', 'jpeg', 'png'];

      $ekstensi = explode('.', $foto['name']);
      $ekstensi = strtolower(end($ekstensi));

      if (!in_array($ekstensi, $ekstensiValid)) {
        return false;
      }

      $ukuran = $foto['size'];

      if ($ukuran > 2000000) {
        return false;
      }

      $filename = uniqid() . "." . $ekstensi;

      //cek foto
      $query = "SELECT foto FROM users where id_users=$id_user";
      $result = mysqli_query($conn, $query);
      $result = mysqli_fetch_assoc($result);
      if ($result['foto'] != "" || $result['foto'] != null) {
        unlink('./assets/images/' . $result['foto']);
      }

      if (!move_uploaded_file($foto['tmp_name'], './assets/images/' . $filename)) {
        return false;
      }
    }



    $query = "UPDATE users SET foto='$filename',username='$username',email='$email',password='$password',nama_depan='$nama_depan',nama_belakang='$nama_belakang',tgl_lahir='$tgl_lahir',jenis_kelamin='$jenis_kelamin',no_telp='$no_telp',alamat='$alamat',negara='$negara',kota='$kota' WHERE id_users=$id_user";
    mysqli_query($conn, $query);


    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }
}
