<?php
require_once('../controller/api/cartController.php');
$cart = new cartController();

# gdelete

if (isset($_GET['id_users']) && isset($_GET['id_book'])) {
  if ($cart->delete($_GET['id_users'], $_GET['id_book']) > 0) {
    $response = [
      "status" => 200,
      "message" => "deleted"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 200,
      "message" => "delete failed"
    ];
    echo json_encode($response);
  }
  # get cart by id
} elseif (isset($_GET['id_users'])) {
  $cart->getCartItemById($_GET['id_users']);
  # insert
} else {
  if ($cart->insert() > 0) {
    $response = [
      "status" => 200,
      "message" => "insert success"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 400,
      "message" => "insert failed. item alredy in cart"
    ];
    echo json_encode($response);
  }
}
