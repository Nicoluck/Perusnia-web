<?php
require_once('./koneksi/koneksi.php');
require_once('./root/base_url.php');
class favoriteController
{
  function __construct()
  {
    global $conn;
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function getSpesificFavorite($id_users, $id_book)
  {
    global $conn;

    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON book.id_users=users.id_users JOIN favorit ON favorit.id_book=book.id_book WHERE favorit.id_users=$id_users AND favorit.id_book=$id_book GROUP BY book.id_book ORDER BY book.id_book ASC";

    $res = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($res);

    $row = mysqli_affected_rows($conn);

    if (isset($row)) {
      return $row;
    }
  }

  public function getFavorite($id_users)
  {
    global $conn;

    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON book.id_users=users.id_users JOIN favorit ON favorit.id_book=book.id_book WHERE favorit.id_users=$id_users GROUP BY book.id_book ORDER BY book.id_book ASC";

    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      return $rows;
    }
  }

  public function insertFavorite($id_users, $id_book)
  {
    global $conn;
    $query = "INSERT INTO favorit (id_book,id_users) VALUES ('$id_book','$id_users')";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }

  public function deleteFavorite($id_users, $id_book)
  {
    global $conn;
    $query = "DELETE FROM favorit where id_book=$id_book AND id_users=$id_users";
    if (!mysqli_query($conn, $query)) {
      return false;
    }
    return mysqli_affected_rows($conn);
  }

  public function searchFavorite($keyword, $id_users)
  {
    global $conn;

    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON book.id_users=users.id_users JOIN favorit ON favorit.id_book=book.id_book WHERE favorit.id_users=$id_users AND book.judul LIKE '%$keyword%' GROUP BY book.id_book ORDER BY book.id_book ASC";

    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      return $rows;
    }
  }
}
