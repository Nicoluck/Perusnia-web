<?php
require_once('../controller/api/userController.php');
$user = new userController();

parse_str(file_get_contents('php://input'), $_DELETE);

if ($user->delete($_DELETE["id_users"]) > 0) {
  echo json_encode([
    "status" => 200,
    "message" => "Deleted!"
  ]);
} else {
  echo json_encode([
    "status" => 400,
    "message" => "Delete failed"
  ]);
}
