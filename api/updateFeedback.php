<?php
require_once('../controller/api/feedbackController.php');
$feedback = new feedbackController();
global $conn;
if (isset($_GET["id_users"]) && isset($_GET["id_book"])) {
  if ($feedback->update($_GET["id_users"], $_GET["id_book"]) > 0) {
    $response = [
      "status" => 200,
      "message" => "Feedback updated"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "status" => 500,
      "message" => "Failed to update" . mysqli_error($conn)
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
