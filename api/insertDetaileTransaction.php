<?php
require_once('../controller/api/transactionController.php');
$tran = new transactionController();

if (isset($_POST['transaction_id'])) {
  $tran->insertDetileTransaction();
} else {
  $response = [
    "status" => 400,
    "message" => "Field is required",
  ];
  echo json_encode($response);
}
