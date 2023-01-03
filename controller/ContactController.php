<?php

use LDAP\Result;

require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class ContactController
{
  function index()
  {
    global $conn;
    $query = "SELECT * FROM contact";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (isset($data)) {
      return $data;
    }
  }

  function saveContact($data)
  {
    global $conn;
    $alamat = $nomor = $hari = $buka = $tutup = $kordinat = "";
    if (isset($data["alamat"])) {
      $alamat = $data["alamat"];
    }
    if (isset($data["nomor"])) {
      $nomor = $data["nomor"];
    }
    if (isset($data["hari"])) {
      $hari = $data["hari"];
    }
    if (isset($data["buka"])) {
      $buka = $data["buka"];
    }
    if (isset($data["tutup"])) {
      $tutup = $data["tutup"];
    }
    if (isset($data["kordinat"])) {
      $kordinat = $data["kordinat"];
    }
    //var_dump($data);

    $query = "INSERT INTO contact (alamat,telepon,hari_buka,jam_buka,jam_tutup,kordinat) VALUES ('$alamat','$nomor','$hari','$buka','$tutup','$kordinat')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function updateContact($data)
  {
    global $conn;
    $alamat = $nomor = $hari = $buka = $tutup = $kordinat = "";
    if (isset($data["alamat"])) {
      $alamat = $data["alamat"];
    }
    if (isset($data["nomor"])) {
      $nomor = $data["nomor"];
    }
    if (isset($data["hari"])) {
      $hari = $data["hari"];
    }
    if (isset($data["buka"])) {
      $buka = $data["buka"];
    }
    if (isset($data["tutup"])) {
      $tutup = $data["tutup"];
    }
    //var_dump($data);

    $query = "UPDATE contact SET alamat= '$alamat', telepon= '$nomor', hari_buka= '$hari', jam_buka= '$buka', jam_tutup= '$tutup'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
}
