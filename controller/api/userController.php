<?php
require_once('../koneksi/koneksi.php');
require_once('../root/base_url.php');

class userController
{
  function __construct()
  {
    global $conn;
    header('Content-Type: application/json');
    require 'auth/auth.php'; //api_authorization

    function validation($data)
    {
      $data = trim($data);
      $data = preg_replace('/\s+/', ' ', $data);
      $data = htmlspecialchars($data);
      return $data;
    }
  }
  function index()
  {
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    $response = [
      "Status" => 200,
      "message" => "Success",
      "data" => $rows
    ];

    return json_encode($response);
  }

  function getUserById($id_users)
  {
    global $conn;
    $query = "SELECT * FROM users where id_users=$id_users";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);

    $response = [
      "Status" => 200,
      "message" => "Success",
      "data" => $res
    ];

    return json_encode($response);
  }


  function insert()
  {
    global $conn;
    $username = $email = $password = $email = $nama_depan = $nama_belakang = $jenis_kelamin = $negara = $kota = "";
    $err = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!isset($_POST['username'])) {
        array_push($err, "username is required");
      } else {
        $username = validation($_POST['username']);
      }
      if (!isset($_POST['email'])) {
        array_push($err, "email is required");
      } else {
        $email = validation($_POST['email']);
      }
      if (!isset($_POST['password'])) {
        array_push($err, "password is required");
      } else {
        $password = password_hash(validation($_POST['password']), PASSWORD_BCRYPT);
      }
      if (!isset($_POST['nama_depan'])) {
        array_push($err, "nama_depan is required");
      } else {
        $nama_depan = validation($_POST['nama_depan']);
      }
      if (!isset($_POST['nama_belakang'])) {
        array_push($err, "nama_belakang is required");
      } else {
        $nama_belakang = validation($_POST['nama_belakang']);
      }
      if (!isset($_POST['jenis_kelamin'])) {
        array_push($err, "jenis_kelamin is required");
      } else {
        $jenis_kelamin = validation($_POST['jenis_kelamin']);
      }
      if (!isset($_POST['negara'])) {
        array_push($err, "negara is required");
      } else {
        $negara = validation($_POST['negara']);
      }
      if (!isset($_POST['kota'])) {
        array_push($err, "kota is required");
      } else {
        $kota = validation($_POST['kota']);
      }
    } else {
      return false;
    }

    //input required check
    if (!$username || !$email || !$password || !$email || !$nama_depan || !$nama_belakang || !$jenis_kelamin || !$negara || !$kota) {

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
    //"/^\w{5,}$/"
    if (!preg_match('/^\w{5,}$/', $username)) { // \w equals "[0-9A-Za-z_]"
      return false;
    }


    $query = "INSERT INTO users (username,email,password,nama_depan,nama_belakang,jenis_kelamin,negara,kota) VALUES ('$username','$email','$password','$nama_depan','$nama_belakang','$jenis_kelamin','$negara','$kota')";
    mysqli_query($conn, $query);


    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }


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
        unlink('../assets/images/' . $result['foto']);
      }

      if (!move_uploaded_file($foto['tmp_name'], '../assets/images/' . $filename)) {
        return false;
      }
      $query = "UPDATE users SET foto='$filename'WHERE id_users=$id_user";
      mysqli_query($conn, $query);
    }



    $query = "UPDATE users SET username='$username',email='$email',password='$password',nama_depan='$nama_depan',nama_belakang='$nama_belakang',tgl_lahir='$tgl_lahir',jenis_kelamin='$jenis_kelamin',no_telp='$no_telp',alamat='$alamat',negara='$negara',kota='$kota' WHERE id_users=$id_user";
    mysqli_query($conn, $query);


    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }

  function delete($id_users)
  {
    global $conn;

    //cek foto
    $query = "SELECT foto FROM users where id_users=$id_users";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($result);
    if ($result['foto'] != "" || $result['foto'] != null) {
      unlink('../assets/images/' . $result['foto']);
    }

    $query = "DELETE FROM users WHERE id_users=$id_users";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function getFiles($filename, $path)
  {
    $ekstensiFile = explode('.', $filename);
    $ekstensiFile = strtolower(end($ekstensiFile));

    $ekstensiImageValid = ['jpg', 'jpeg', 'png'];
    $ekstensiPdfValid = ['pdf'];



    if (in_array($ekstensiFile, $ekstensiImageValid)) {
      header('Content-Type: image/png');
      header('Content-Length: ' . filesize('../assets/images/' . $filename));

      @readfile($path . $filename);
    } elseif (in_array($ekstensiFile, $ekstensiPdfValid)) {
      header("Content-type: application/$ekstensiFile");
      header("Content-Disposition: inline; filename=$filename");
      header('Content-Length: ' . filesize('../assets/images/' . $filename));

      @readfile($path . $filename);
    } else {
      echo "Ekstensi file tidak cocok";
    }
  }
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
}
