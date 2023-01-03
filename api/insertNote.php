<?php
require_once('../controller/api/noteController.php');
$note = new noteController();

if ($note->insert() > 0) {
  $response = [
    "status" => 200,
    "message" => "Insert success"
  ];
  echo json_encode($response);
} else {
  $response = [
    "status" => 500,
    "message" => "Insert failed"
  ];
  echo json_encode($response);
}
