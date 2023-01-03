<?php
require_once('../controller/api/userController.php');
$user = new userController();


if ($user->insert() > 0) {
  echo json_encode([
    "status" => 201,
    "message" => "Sign Up Success, Please Sign In!!"
  ]);
} else {
  echo json_encode([
    "status" => 400,
    "message" => "Username harus terdapat huruf dan angaka"
  ]);
}
