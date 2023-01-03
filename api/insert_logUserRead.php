<?php
require_once('../controller/api/bookController.php');
$book = new bookController();

if (isset($_POST['id_users']) && isset($_POST['id_book'])) {
  if ($book->check_userLog($_POST['id_users']) > 0) {
    $book->updateLogUsersRead();
  } else {
    $book->insertLogUsersRead();
  }
} else {
  $response = [
    "status" => 400,
    "message" => "params required",
  ];
  echo json_encode($response);
}
