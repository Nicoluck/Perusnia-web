<?php
require_once('../koneksi/koneksi.php');
require_once('../root/base_url.php');
class feedbackController
{
  function __construct()
  {
    global $conn;
    header('Content-Type: application/json');
    require 'auth/auth.php'; //api_authorization
    function validation($data)
    {
      $data = trim($data);
      $data = preg_replace('/\s+/', ' ', $data);
      $data = htmlspecialchars($data);
      return $data;
    }
  }

  public function getAllRatebook($id_book)
  {
    global $conn;
    $query = "SELECT rate_book.id_rate_book,users.foto,CONCAT(users.nama_depan,' ',users.nama_belakang) as nama_lengkap, rate_book.rate_score, rate_book.created_at,rate_book.comment FROM rate_book JOIN users ON rate_book.id_users=users.id_users WHERE rate_book.id_book=$id_book";
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
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
        "status" => 500,
        "message" => "failed ge data"
      ];
      echo json_encode($response);
    }
  }

  public function getTopRateBook()
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book JOIN rate_book ON book.id_book=rate_book.id_book join users ON book.id_users=users.id_users GROUP BY book.id_book ORDER BY rate_book DESC LIMIT 10";
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }

    if ($rows != null) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $rows
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 500,
        "message" => "Server error",
      ];
      echo json_encode($response);
    }
  }

  //CRUD rate book
  public function getSpesificRateBook($id_users, $id_book)
  {
    global $conn;
    $query = "SELECT rate_book.id_rate_book,users.foto,CONCAT(users.nama_depan,' ',users.nama_belakang) as nama_lengkap, rate_book.rate_score, rate_book.created_at,rate_book.comment FROM rate_book JOIN users ON rate_book.id_users=users.id_users WHERE rate_book.id_book=$id_book AND rate_book.id_users=$id_users";
    $res = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($res);

    if ($result != null) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $result
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 500,
        "message" => "Data is null",
      ];
      echo json_encode($response);
    }
  }

  public function insert()
  {
    global $conn;
    $rate_score = validation($_POST['rate_score']);
    $comment = validation($_POST['comment']);
    $id_book = validation($_POST['id_book']);
    $id_users = validation($_POST['id_users']);

    if (!$rate_score || !$id_book || !$id_users) {
      return false;
    }

    $query = "INSERT INTO rate_book (rate_score,comment,id_book,id_users) VALUES ('$rate_score','$comment','$id_book','$id_users')";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }
  public function update($id_users, $id_book)
  {
    global $conn;

    $rate_score = validation($_POST['rate_score']);
    $comment = validation($_POST['comment']);

    if (!$rate_score || !$id_book || !$id_users) {
      return false;
    }
    $query = "UPDATE rate_book SET rate_score='$rate_score',comment='$comment',id_book='$id_book',id_users='$id_users' WHERE id_book=$id_book and id_users=$id_users";

    if (!mysqli_query($conn, $query)) {
      return false;
    }

    return mysqli_affected_rows($conn);
  }
  public function delete($id_users, $id_book)
  {
    global $conn;
    $query = "DELETE FROM rate_book WHERE id_book=$id_book AND id_users=$id_users";
    if (!mysqli_query($conn, $query)) {
      return false;
    }
    return mysqli_affected_rows($conn);
  }
  public function cek_feedback($id_users, $id_book)
  {
    global $conn;
    $query = "SELECT * FROM rate_book where id_users=$id_users AND id_book=$id_book";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result);
  }
}
