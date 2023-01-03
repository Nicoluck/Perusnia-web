<?php
require './controller/cartController.php';
$cart = new cartController();

if (isset($_GET["id_users"]) && isset($_GET["id_book"])) {
  if ($cart->delete($_GET["id_users"], $_GET["id_book"])) {
    $_SESSION['alert']['success'] = "Data berhasil di hapus!!";
    header('Location: cart.php');
  } else {
    $_SESSION['alert']['failed'] = "Data berhasil di hapus!!";
    header('Location: cart.php');
  }
}
