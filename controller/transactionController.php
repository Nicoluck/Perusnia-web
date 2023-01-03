<?php
require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class transactionController
{
  function __construct()
  {
    global $conn;
    if (!isset($_SESSION)) {
      session_start();
    }
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
      return $rows;
    }
  }
  public function insertDetileTransaction()
  {
    global $conn;
    $transaction_id = $_POST['transaction_id'];
    $id_users = $_POST['id_users'];
    $id_book = $_POST['id_book'];

    $query = "insert into detail_transaction (transaction_id,id_users,id_book) VALUES ('$transaction_id','$id_users','$id_book')";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
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
      return $rows;
    }
  }
}
