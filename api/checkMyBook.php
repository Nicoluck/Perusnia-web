<?php
require_once('../controller/api/bookController.php');
$book = new bookController();

if (isset($_GET['id_users']) && isset($_GET['id_book'])) {
  if ($book->check_mybook($_GET['id_users'], $_GET['id_book']) > 0) {
    $response = [
      "status" => 200,
      "message" => "Success"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 400,
      "message" => "Failed"
    ];
    echo json_encode($response);
  }
} else {
  $response = [
    "status" => 400,
    "message" => "params required"
  ];
  echo json_encode($response);
}
