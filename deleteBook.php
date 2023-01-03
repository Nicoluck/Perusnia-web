<?php
require './controller/bookController.php';
$bookCatalog = new bookController();
if ($bookCatalog->delete($_GET["id_book"]) > 0) {
  $_SESSION["success"] = "Data berhasil di Hapus!";
  header("Location: bookCatalog.php");
} else {
  $_SESSION["failed"] = "Data tidak di Hapus!";
  header("Location: bookCatalog.php");
}
