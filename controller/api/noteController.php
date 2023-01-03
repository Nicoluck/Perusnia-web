<?php
require_once('../koneksi/koneksi.php');
require_once('../root/base_url.php');
class noteController
{
  function __construct()
  {
    global $conn;
    header('Content-Type: application/json');
    require 'auth/auth.php'; //api_authorization
  }

  public function getSpesificNote($id_users)
  {
    global $conn;
    $query = "SELECT * FROM notes where id_users=$id_users";
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }

    if (isset($rows)) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $rows
      ];
    } else {
      $response = [
        "status" => 500,
        "message" => "Data Not Found",
      ];
    }

    return json_encode($response);
  }

  public function insert()
  {
    global $conn;
    $judul = $isi = $id_users = "";

    if (isset($_POST["id_users"])) {
      $id_users = $_POST["id_users"];
      if (isset($_POST["judul"])) {
        $judul = $_POST["judul"];
      }
      if (isset($_POST["isi"])) {
        $isi = $_POST["isi"];
      }
    } else {
      return false;
    }

    $query = "INSERT INTO notes (id_users,judul,isi) VALUES ('$id_users','$judul','$isi')";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }
  public function update($id_notes)
  {
    global $conn;
    $judul = $isi = "";

    if (isset($_POST["judul"])) {
      $judul = $_POST["judul"];
    } else {
      $judul = "";
    }
    if (isset($_POST["isi"])) {
      $isi = $_POST["isi"];
    } else {
      $isi = "";
    }

    $query = "UPDATE notes SET judul='$judul',isi='$isi' WHERE id_notes=$id_notes ";

    if (!mysqli_query($conn, $query)) {
      echo "gagal";
      die;
      return false;
    }

    return mysqli_affected_rows($conn);
  }
  public function delete($id_notes)
  {
    global $conn;
    $query = "DELETE FROM notes WHERE id_notes=$id_notes";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }
}
