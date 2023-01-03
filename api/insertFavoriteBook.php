<?php
require_once('../controller/api/favoriteController.php');
$favorite = new favoriteController();

if (isset($_POST['id_users']) && isset($_POST['id_book'])) {
  if ($favorite->insertFavorite($_POST['id_users'], $_POST['id_book']) > 0) {
    $response = [
      "status" => 200,
      "message" => "Saved"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 500,
      "message" => "Failed"
    ];
    echo json_encode($response);
  }
} else {
  $response = [
    "status" => 400,
    "message" => "Field is required"
  ];
  echo json_encode($response);
}
