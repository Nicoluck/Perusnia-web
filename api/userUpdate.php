<?php
require_once('../controller/api/userController.php');
$user = new userController();

if ($user->update($_GET['id_users']) > 0) {
  echo json_encode([
    "status" => 200,
    "message" => "Updated!"
  ]);
} else {
  echo json_encode([
    "status" => 400,
    "message" => "Failed to Update data | Image < 2Mb"
  ]);
}
