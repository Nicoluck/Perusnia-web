<?php
require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class dashboardController
{
  function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    if ($_SESSION["userdata"]["is-login"] != true) {
      $_SESSION["failed"] = "Login required";
      header("Location: signin.php");
    }
    global $conn;
  }

  public function book_total()
  {
    global $conn;
    $query = "SELECT COUNT(*) as book_total FROM book";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    if (isset($res)) {
      return $res['book_total'];
    }
  }
  public function user_total()
  {
    global $conn;
    $query = "SELECT COUNT(*) as users_total FROM users";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    if (isset($res)) {
      return $res['users_total'];
    }
  }
  public function transaction_total()
  {
    global $conn;
    $query = "SELECT COUNT(*) as transaction_total FROM transaction WHERE month(transaction.transaction_time)=" . date("m");
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    if (isset($res)) {
      return $res['transaction_total'];
    }
  }
  public function transactionTotalPerMonth()
  {
    global $conn;
    $query = "SELECT SUM(transaction.gross_amount) as total ,month(transaction.transaction_time) as bulan FROM transaction WHERE year(transaction.transaction_time)=2022 GROUP BY month(transaction.transaction_time)";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      return $rows;
    }
  }
}
