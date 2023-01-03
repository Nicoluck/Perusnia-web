<?php
require_once('../controller/api/favoriteController.php');
$favorite = new favoriteController();

if (isset($_GET['id_users']) && isset($_GET['id_book'])) {
  $favorite->getSpesificFavorite($_GET['id_users'], $_GET['id_book']);
} elseif (isset($_GET['id_users'])) {
  $favorite->getFavorite($_GET['id_users'],);
} else {
  $response = [
    "status" => 400,
    "message" => "Params is required"
  ];
  echo json_encode($response);
}
