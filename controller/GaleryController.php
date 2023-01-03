<?php

require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class GaleryController
{
  function index()
  {
    global $conn;
    $query = "SELECT * FROM galeri";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    return $rows;
  }

  function tampil()
  {
    global $conn;
    $query = "SELECT * FROM galeri order by id_galeri ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    return $rows;
  }

  function delete($id_galeri)
  {
    global $conn;

    $gambarQuery = "SELECT * FROM galeri where id_galeri=" . $id_galeri;
    $gambarRes = mysqli_query($conn, $gambarQuery);
    while ($row = mysqli_fetch_assoc($gambarRes)) {
      $rows[] = $row;
    }
    $gambar = $rows[0];

    if (
      file_exists("./assets/images/" . $gambar['foto'])
    ) {
      unlink("./assets/images/" . $gambar['foto']);
    }


    $query = "DELETE FROM galeri where id_galeri=" . $id_galeri;
    mysqli_query($conn, $query);

    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }

  function saveGaleri($data)
  {
    global $conn;
    $gambar = $data['foto'];
    $deskripsi = $data['deskripsi'];

    $query = "INSERT TO galeri VALUES ('','$gambar','$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }


  //baru
  function addGaleri()
  {
    global $conn;

    if (isset($_POST["submit"])) {

      $deskripsi = $_POST["deskripsi"] == "<p><br></p>" ? "" : $_POST["deskripsi"];
    }


    if (!$deskripsi) {
      $_SESSION["failed"]["deskripsi"] = "deskripsi is required";
    }


    //upload
    function upload()
    {
      $gambar_galeri = $_FILES["gambar"];

      ////validasi ekstensi
      $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];

      $ekstensiGambar = explode('.', $gambar_galeri['name']);
      $ekstensiGambar = strtolower(end($ekstensiGambar));

      //cek ekestensi
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        if ($ekstensiGambar && !in_array($ekstensiGambar, $ekstensiGambarValid)) {
          $_SESSION["failed"]["gambar"]['extension'] = "gambar exstension not allowed";
        }

        return false;
      }

      //validasi ukuran
      $ukuranGambarGaleri = $gambar_galeri["size"];

      if ($ukuranGambarGaleri > 3000000) {
        $_SESSION["failed"]["gambar"]['size'] = "gambar > 3 Mb";
        return false;
      }

      $filename = [
        "gambar" => $gambarFilename = uniqid() . "." . $ekstensiGambar
      ];

      move_uploaded_file($gambar_galeri['tmp_name'], './assets/images/' . $filename["gambar"]);

      return [$filename['gambar']];
    }

    list($gambarFilename) = upload();
    if (!$gambarFilename) {
      if (!$gambarFilename) {
        $_SESSION["failed"]["gambar"]['required'] = "gambar is required";
      }
      return false;
    }


    $data = [
      "deskripsi" => $deskripsi
    ];

    // var_dump($data);
    // die;


    $query = "INSERT INTO galeri (foto,deskripsi) VALUES ('$gambarFilename','$deskripsi')";

    mysqli_query($conn, $query);

    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }

  public function updateGaleri($id_galeri)
  {

    global $conn;
    if (isset($_POST["submit"])) {
      $deskripsi = $_POST["deskripsi"];

      if (!$deskripsi) {
        $_SESSION["failed"]["deskripsi"] = "deskripsi is required";
      }

      $query_gambar = "SELECT * from galeri where id_galeri=$id_galeri";
      $hasil_hambar = mysqli_query($conn, $query_gambar);
      while ($row = mysqli_fetch_assoc($hasil_hambar)) {
        $rows[] = $row;
      }
      $Currentgambar = $rows[0];

      if ($_FILES['gambar']['name'] != "") {

        $gambar = $_FILES["gambar"];

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $gambar['name']);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
          if ($ekstensiGambar && !in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $_SESSION["failed"]["gambar"]['extension'] = "gambar exstension not allowed";
          }
          return false;
        }

        $ukuranBookCover = $gambar["size"];
        if ($ukuranBookCover > 3000000) {
          $_SESSION["failed"]["gambar"]['size'] = "gambar > 3 Mb";
          return false;
        }

        $filename = [
          "GambarFilename" => uniqid() . "." . $ekstensiGambar
        ];
        unlink("./assets/images/" . $Currentgambar["foto"]);
        move_uploaded_file($gambar['tmp_name'], './assets/images/' . $filename["GambarFilename"]);

        $gambarFilename = $filename['GambarFilename'];

        $query = "UPDATE galeri SET foto='$gambarFilename' where id_galeri='$id_galeri'";

        mysqli_query($conn, $query);
      } else {
        $query = "UPDATE galeri SET deskripsi='$deskripsi' where id_galeri='$id_galeri'";
        mysqli_query($conn, $query);
      }

      if (mysqli_error($conn)) {
        echo mysqli_error($conn);
        return false;
      }

      return mysqli_affected_rows($conn);
    }
  }

  public function getGaleriById($id_galeri)
  {
    global $conn;
    $query = "SELECT * from galeri where id_galeri=$id_galeri";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    if (isset($res)) {
      return $res;
    }
  }
}
