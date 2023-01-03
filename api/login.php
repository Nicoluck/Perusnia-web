<?php
require_once('../controller/api/userController.php');
$user = new userController();

if (isset($_POST["email"]) && isset($_POST['password'])) {

  $email = $_POST["email"];
  $pass = $_POST["password"];

  $user = $user->cek_data($email, $pass);
  if ($user != false) {
    $response = [
      "error" => false,
      "message" => "success",
      "user" => [
        "id_users" => $user["id_users"],
        "username" => $user["username"],
        "email" => $user["email"],
        "password" => $user["password"]
      ],
    ];
    echo json_encode($response);
  } else {
    $response = [
      "error" => true,
      "message" => "email or password invalid",
    ];
    echo json_encode($response);
  }
} else {
  $response = [
    "error" => true,
    "message" => "Field is required",
  ];
  echo json_encode($response);
}
