<?php
require_once '../controller/api/bookController.php';
$book = new bookController();

if (isset($_GET['keyword'])) {
  echo $book->serach($_GET['keyword']);
} else {
  $response = [
    "status" => 400,
    "message" => "keyowrd required",
  ];
  echo json_encode($response);
}
