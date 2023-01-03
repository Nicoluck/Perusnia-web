<?php
require_once('../controller/api/feedbackController.php');
$rate = new feedbackController();

if (isset($_GET["id_users"]) && isset($_GET['id_book'])) {
  $rate->getSpesificRateBook($_GET["id_users"], $_GET['id_book']);
} elseif (isset($_GET['id_book'])) {
  $rate->getAllRatebook($_GET['id_book']);
} else {
  $response = [
    "status" => 400,
    "message" => "parameter required"
  ];
  echo json_encode($response);
}
