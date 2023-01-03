<?php
require_once('../controller/api/transactionController.php');
$tran = new transactionController();

if (isset($_GET['transaction_id'])) {
  $tran->getDetileUserTransaction($_GET['transaction_id']);
} else {
  $response = [
    "status" => 400,
    "message" => "params required"
  ];
  echo json_encode($response);
}
