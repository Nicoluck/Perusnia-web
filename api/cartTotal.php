<?php
require_once('../controller/api/cartController.php');
$cart = new cartController();

if ($_GET['id_users']) {
  $cart->getItemPriceTotal($_GET['id_users']);
} else {
  $response = [
    "status" => 401,
    "message" => "id_users required",
  ];
}
