<?php
require_once('../controller/api/feedbackController.php');
$feedback = new feedbackController();

if (isset($_GET["id_users"]) && isset($_GET["id_book"])) {
  if ($feedback->delete($_GET["id_users"], $_GET["id_book"]) > 0) {
    $response = [
      "status" => 200,
      "message" => "Feedback deleted"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 500,
      "message" => "Failed to delete"
    ];
    echo json_encode($response);
  }
} else {
  $response = [
    "status" => 400,
    "message" => "Params is required"
  ];
  echo json_encode($response);
}
