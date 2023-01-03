<?php
require_once('../controller/api/cartController.php');
$cart = new cartController();

if (isset($_GET['id_users']) != null) {
  $cart->deleteAllCartUsers($_GET['id_users']);
} else {
  $response = [
    "status" => 400,
    "message" => "Field required",
  ];
  echo json_encode($response);
}
