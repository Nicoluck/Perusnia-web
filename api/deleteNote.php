<?php
require_once('../controller/api/noteController.php');
$note = new noteController();

if (isset($_GET["id_notes"])) {

  if ($note->delete($_GET["id_notes"]) > 0) {
    $response = [
      "status" => 200,
      "message" => "Delete success"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 500,
      "message" => "Delete failed"
    ];
    echo json_encode($response);
  }
} else {
  $response = [
    "status" => 400,
    "message" => "id_note required"
  ];
  echo json_encode($response);
}
