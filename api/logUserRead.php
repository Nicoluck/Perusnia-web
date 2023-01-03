<?php
require_once('../controller/api/bookController.php');
$book = new bookController();

if (isset($_GET["id_users"])) {
  $book->getLogUsersRead($_GET["id_users"]);
} else {
  $response = [
    "status" => 400,
    "message" => "params required",
  ];
  echo json_encode($response);
}
