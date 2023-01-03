<?php
require_once('../koneksi/koneksi.php');
require_once('../root/base_url.php');
class transactionController
{
  function __construct()
  {
    global $conn;
    header('Content-Type: application/json');
    require 'auth/auth.php'; //api_authorization
  }

  public function getUserTransaction($id_users)
  {
    global $conn;
    $query = "SELECT * FROM transaction JOIN va_numbers ON va_numbers.id_transaction=transaction.id_transaction LEFT JOIN payment_amount ON payment_amount.id_transaction=transaction.id_transaction JOIN detail_transaction ON detail_transaction.transaction_id=transaction.transaction_id WHERE detail_transaction.id_users=$id_users GROUP BY transaction.id_transaction";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $rows
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "failed" . mysqli_error($conn)
      ];
      echo json_encode($response);
    }
  }

  public function getDetileUserTransaction($transaction_id)
  {
    global $conn;
    $query = "SELECT * FROM detail_transaction JOIN transaction ON detail_transaction.transaction_id=transaction.transaction_id JOIN users ON detail_transaction.id_users = users.id_users JOIN book ON detail_transaction.id_book=book.id_book WHERE detail_transaction.transaction_id='$transaction_id'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $rows
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "failed"
      ];
      echo json_encode($response);
    }
  }

  public function insertDetileTransaction()
  {
    global $conn;
    $transaction_id = $_POST['transaction_id'];
    $id_users = $_POST['id_users'];
    $id_book = $_POST['id_book'];

    $query = "insert into detail_transaction (transaction_id,id_users,id_book) VALUES ('$transaction_id','$id_users','$id_book')";

    if (mysqli_query($conn, $query)) {
      $response = [
        "status" => 200,
        "message" => "success",
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "Failed" . mysqli_error($conn),
      ];
      echo json_encode($response);
    }
  }

  public function cek_transaksi($transaction_id)
  {
    global $conn;
    $query = "select * from transaction where transaction_id='$transaction_id'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result);
  }

  public function insert()
  {
    global $conn;
    $json_result = file_get_contents('php://input');
    $result = json_decode($json_result, "true");

    $va_number = $bank = $transaction_time = $transaction_status = $transaction_id = $status_message = $status_code = $signature_key = $settlement_time = $payment_type = $amount  = $paid_at = $order_id = $merchant_id = $gross_amount = $fraud_status = $currency = $biller_code = $bill_key = $approval_code = "";

    if (isset($result['va_numbers'][0]['va_number'])) {
      if (isset($result['va_numbers'][0]['va_number'])) {
        $va_number = $result['va_numbers'][0]['va_number'];
      }
      if (isset($result['va_numbers'][0]['bank'])) {
        $bank = $result['va_numbers'][0]['bank'];
      }
    }
    if (isset($result['transaction_time'])) {
      $transaction_time = $result['transaction_time'];
    }
    if (isset($result['transaction_status'])) {
      $transaction_status = $result['transaction_status'];
    }
    if (isset($result['transaction_id'])) {
      $transaction_id = $result['transaction_id'];
    }
    if (isset($result['status_message'])) {
      $status_message = $result['status_message'];
    }
    if (isset($result['status_code'])) {
      $status_code = $result['status_code'];
    }
    if (isset($result['signature_key'])) {
      $signature_key = $result['signature_key'];
    }
    if (isset($result['settlement_time'])) {
      $settlement_time = $result['settlement_time'];
    }
    if (isset($result['payment_type'])) {
      $payment_type = $result['payment_type'];
    }
    if (isset($result['payment_amounts'][0]['amount'])) {
      if (isset($result['payment_amounts'][0]['amount'])) {
        $amount = $result['payment_amounts'][0]['amount'];
      }
      if (isset($result['payment_amounts'][0]['paid_at'])) {
        $paid_at = $result['payment_amounts'][0]['paid_at'];
      }
    }
    if (isset($result['order_id'])) {
      $order_id = $result['order_id'];
    }
    if (isset($result['merchant_id'])) {
      $merchant_id = $result['merchant_id'];
    }
    if (isset($result['gross_amount'])) {
      $gross_amount = $result['gross_amount'];
    }
    if (isset($result['fraud_status'])) {
      $fraud_status = $result['fraud_status'];
    }
    if (isset($result['currency'])) {
      $currency = $result['currency'];
    }
    if (isset($result['biller_code'])) {
      $biller_code = $result['biller_code'];
    }
    if (isset($result['bill_key'])) {
      $bill_key = $result['bill_key'];
    }
    if (isset($result['approval_code'])) {
      $approval_code = $result['approval_code'];
    }


    //insert transaction and payment_amount and va_numbers
    $query = "START TRANSACTION; INSERT INTO transaction (transaction_time,transaction_status,transaction_id,status_message,status_code,signature_key,settlement_time,payment_type,order_id,merchant_id,gross_amount,fraud_status,currency,biller_code,bill_key,approval_code) VALUES ('$transaction_time','$transaction_status','$transaction_id','$status_message','$status_code','$signature_key','$settlement_time','$payment_type','$order_id','$merchant_id','$gross_amount','$fraud_status','$currency','$biller_code','$bill_key','$approval_code'); INSERT INTO va_numbers (va_number,bank,id_transaction) VALUES ('$va_number','$bank',@id_transaction:= LAST_INSERT_ID()); INSERT INTO payment_amount (amount,paid_at,id_transaction) VALUES ('$amount','$paid_at',@id_transaction); COMMIT;";


    if (mysqli_multi_query($conn, $query)) {
      // if ($transaction_status == "settlement") {
      //   $query1 = "INSERT INTO mybook(id_book,id_users) SELECT detail_transaction.id_book, detail_transaction.id_users FROM detail_transaction WHERE detail_transaction.transaction_id='$transaction_id'";
      //   mysqli_query($conn, $query1);
      // }
      $response = [
        "status" => 200,
        "message" => "created "
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "insert failed, " . mysqli_error($conn)
      ];
      echo json_encode($response);
    }
  }

  public function update($transaction_id)
  {
    global $conn;
    $json_result = file_get_contents('php://input');
    $result = json_decode($json_result, "true");

    // $va_number = $bank = $amount  = $paid_at =

    $transaction_time = $transaction_status = $transaction_id = $status_message = $status_code = $signature_key = $settlement_time = $payment_type =  $order_id = $merchant_id = $gross_amount = $fraud_status = $currency = $biller_code = $bill_key = $approval_code = "";

    if (isset($result['va_numbers'][0]['va_number'])) {
      if (isset($result['va_numbers'][0]['va_number'])) {
        $va_number = $result['va_numbers'][0]['va_number'];
      }
      if (isset($result['va_numbers'][0]['bank'])) {
        $bank = $result['va_numbers'][0]['bank'];
      }
    }
    if (isset($result['transaction_time'])) {
      $transaction_time = $result['transaction_time'];
    }
    if (isset($result['transaction_status'])) {
      $transaction_status = $result['transaction_status'];
    }
    if (isset($result['transaction_id'])) {
      $transaction_id = $result['transaction_id'];
    }
    if (isset($result['status_message'])) {
      $status_message = $result['status_message'];
    }
    if (isset($result['status_code'])) {
      $status_code = $result['status_code'];
    }
    if (isset($result['signature_key'])) {
      $signature_key = $result['signature_key'];
    }
    if (isset($result['settlement_time'])) {
      $settlement_time = $result['settlement_time'];
    }
    if (isset($result['payment_type'])) {
      $payment_type = $result['payment_type'];
    }
    if (isset($result['payment_amounts'][0]['amount'])) {
      if (isset($result['payment_amounts'][0]['amount'])) {
        $amount = $result['payment_amounts'][0]['amount'];
      }
      if (isset($result['payment_amounts'][0]['paid_at'])) {
        $paid_at = $result['payment_amounts'][0]['paid_at'];
      }
    }
    if (isset($result['order_id'])) {
      $order_id = $result['order_id'];
    }
    if (isset($result['merchant_id'])) {
      $merchant_id = $result['merchant_id'];
    }
    if (isset($result['gross_amount'])) {
      $gross_amount = $result['gross_amount'];
    }
    if (isset($result['fraud_status'])) {
      $fraud_status = $result['fraud_status'];
    }
    if (isset($result['currency'])) {
      $currency = $result['currency'];
    }
    if (isset($result['biller_code'])) {
      $biller_code = $result['biller_code'];
    }
    if (isset($result['bill_key'])) {
      $bill_key = $result['bill_key'];
    }
    if (isset($result['approval_code'])) {
      $approval_code = $result['approval_code'];
    }


    //insert transaction and payment_amount and va_numbers
    $query = "UPDATE transaction SET transaction_time='$transaction_time',transaction_status='$transaction_status',transaction_id='$transaction_id',status_message='$status_message',status_code='$status_code',signature_key='$signature_key',settlement_time='$settlement_time',payment_type='$payment_type',order_id='$order_id',merchant_id='$merchant_id',gross_amount='$gross_amount',fraud_status='$fraud_status',currency='$currency',biller_code='$biller_code',bill_key='$bill_key',approval_code='$approval_code' WHERE transaction_id='$transaction_id'";

    if (mysqli_query($conn, $query)) {
      if ($transaction_status == "settlement") {
        $query1 = "INSERT INTO mybook(id_book,id_users) SELECT detail_transaction.id_book, detail_transaction.id_users FROM detail_transaction WHERE detail_transaction.transaction_id='$transaction_id'";
        mysqli_query($conn, $query1);
      }
      $response = [
        "status" => 200,
        "message" => "sucess"
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "update failed, " . mysqli_error($conn)
      ];
      echo json_encode($response);
    }
  }
}
