<?php
require_once('../controller/api/transactionController.php');
$tran = new transactionController();

if (isset($_GET['id_users'])) {
  $tran->getUserTransaction($_GET['id_users']);
} else {
  $response = [
    "status" => 400,
    "message" => "params required"
  ];
  echo json_encode($response);
}
