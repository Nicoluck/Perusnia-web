<?php

use LDAP\Result;

require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class AboutController
{
  function index()
  {
    global $conn;
    $query = "SELECT * FROM about WHERE id_about = 1";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    return $data;
  }

  function update($id_about)
  {
    global $conn;

    if (isset($_POST["submit"])) {

      $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    
    }

    if (!$deskripsi) {
      $_SESSION["failed"]["deskripsi"] = "deskripsi is required";
    }



    $query_gambar = "SELECT * FROM about WHERE id_about=$id_about";

    $hasil_hambar = mysqli_query($conn, $query_gambar);
    while ($row = mysqli_fetch_assoc($hasil_hambar)) {
      $rows[] = $row;
    }
    $gambar1 = $rows[0];

    if ($_FILES['gambar']['name'] != "") {
      if ($_FILES['gambar']['name'] != "") {

        $gambar = $_FILES["gambar"];

        $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiAboutGambar = explode('.', $gambar['name']);
        $ekstensiAboutGambar = strtolower(end($ekstensiAboutGambar));

        if (!in_array($ekstensiAboutGambar, $ekstensigambarValid)) {
          if ($ekstensiAboutGambar && !in_array($ekstensiAboutGambar, $ekstensigambarValid)) {
            $_SESSION["failed"]["gambar"]['extension'] = "gambar exstension not allowed";
          }
          return false;
        }

        $ukuranBookgambar = $gambar["size"];
        if ($ukuranBookgambar > 2000000) {
          $_SESSION["failed"]["gambar"]['size'] = "gambar > 2 Mb";
          return false;
        }

        $filename = [
          "gambarName" => uniqid() . "." . $ekstensiAboutGambar
        ];
        unlink("./assets/images/" . $gambar1["foto_about"]);
        move_uploaded_file($gambar['tmp_name'], './assets/images/' . $filename["gambarName"]);

        $gambarFilename = $filename['gambarName'];

        $query = "UPDATE about SET foto_about='$gambarFilename' where id_about='$id_about'";

        mysqli_query($conn, $query);
      }
      
    } else {
      $data = [
        "isi_about" => $deskripsi,
      ];

      $query = "UPDATE about SET isi_about='$deskripsi'";
      mysqli_query($conn, $query);
    }

    if (mysqli_error($conn)) {
      echo mysqli_error($conn);
      return false;
    }

    return mysqli_affected_rows($conn);
  }
}