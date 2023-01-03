<?php
require_once('../controller/api/transactionController.php');
$tran = new transactionController();

$json_result = file_get_contents('php://input');
$result = json_decode($json_result, "true");

if (isset($result['transaction_id'])) {
  if ($tran->cek_transaksi($result['transaction_id']) > 0) {
    $tran->update($result['transaction_id']);
  } else {
    $tran->insert();
  }
} else {
  $response = [
    "status" => 400,
    "message" => "Invalid"
  ];
  echo json_encode($response);
}
