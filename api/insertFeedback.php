<?php
require_once('../controller/api/feedbackController.php');
$feedback = new feedbackController();

if ($feedback->insert() > 0) {
  $response = [
    "status" => 200,
    "message" => "Feedback success"
  ];
  echo json_encode($response);
} else {
  $response = [
    "status" => 400,
    "message" => "Failed to Insert"
  ];
  echo json_encode($response);
}
