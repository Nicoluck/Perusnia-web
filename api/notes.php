<?php
require_once('../controller/api/noteController.php');
$note = new noteController();

if (isset($_GET["id_users"])) {
  echo $note->getSpesificNote($_GET["id_users"]);
} else {
  $response = [
    "status" => 400,
    "message" => "id_users is required",
  ];
  echo json_encode($response);
}
