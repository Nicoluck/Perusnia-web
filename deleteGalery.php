<?php
require './controller/GaleryController.php';
$galeri = new GaleryController();
if ($galeri->delete($_GET["id_galeri"]) > 0) {
  $_SESSION["success"] = "Data berhasil di Hapus!";
  header("Location: galeri.php");
} else {
  $_SESSION["failed"] = "Data tidak di Hapus!";
  header("Location: galeri.php");
}
