<?php
require './koneksi/koneksi.php';
require_once('./root/base_url.php');

class cartController
{
  function __construct()
  {
    global $conn;
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function getCartItemById($id_users)
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM cart_item JOIN book ON cart_item.id_book=book.id_book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON cart_item.id_users=users.id_users WHERE cart_item.id_users=$id_users GROUP BY book.id_book ORDER BY cart_item.id_cart_item ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    if (isset($rows)) {
      return $rows;
    }
  }

  public function insert()
  {
    global $conn;
    $id_users = $_POST["id_users"];
    $id_book = $_POST["id_book"];

    $query = "INSERT INTO cart_item (id_users,id_book) VALUES ('$id_users','$id_book')";
    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }

  public function delete($id_users, $id_book)
  {
    global $conn;
    $query = "DELETE FROM cart_item WHERE id_users=$id_users AND id_book=$id_book";
    if (!mysqli_query($conn, $query)) {
      return false;
    }
    return mysqli_affected_rows($conn);
  }

  public function getItemPriceTotal($id_users)
  {
    global $conn;
    $query = "SELECT users.id_users,SUM(book.harga) as total_harga,COUNT(*) as total_item FROM cart_item JOIN book ON cart_item.id_book=book.id_book JOIN users ON cart_item.id_users=users.id_users WHERE cart_item.id_users=$id_users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
  }

  public function deleteAllCartUsers($id_users)
  {
    global $conn;
    $query = "DELETE FROM cart_item where id_users=$id_users";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
}
