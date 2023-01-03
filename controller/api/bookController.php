<?php
require_once('../koneksi/koneksi.php');
require_once('../root/base_url.php');
class bookController
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

  public function index()
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book join users ON book.id_users=users.id_users GROUP BY book.id_book ORDER BY book.id_book ASC";
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }
    $response = [
      "status" => 200,
      "message" => "Success",
      "data" => $rows
    ];
    return json_encode($response);
  }

  public function getBookById($id_book)
  {
    global $conn;
    $query = "SELECT * FROM book where id_book=$id_book";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);

    $response = [
      "Status" => 200,
      "message" => "Success",
      "data" => [$res]
    ];

    return json_encode($response);
  }

  public function getBookUsersById($id_users)
  {
    global $conn;
    $query = "SELECT * FROM book where id_users=$id_users";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);

    $response = [
      "Status" => 200,
      "message" => "Success",
      "data" => $res
    ];

    return json_encode($response);
  }

  public function serach($keyword)
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book join users ON book.id_users=users.id_users WHERE book.judul LIKE '%$keyword%' GROUP BY book.id_book ORDER BY book.id_book ASC";

    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }
    $response = [
      "status" => 200,
      "message" => "Success",
      "data" => $rows
    ];
    return json_encode($response);
  }

  public function check_mybook($id_users, $id_book)
  {
    global $conn;
    $query = "SELECT * FROM mybook WHERE mybook.id_book=$id_book AND mybook.id_users=$id_users";
    if (!mysqli_query($conn, $query)) {
      return false;
    }
    return mysqli_affected_rows($conn);
  }
  public function getMyBookUsers($id_users)
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON book.id_users=users.id_users JOIN mybook ON mybook.id_book=book.id_book WHERE mybook.id_users=$id_users GROUP BY mybook.id_book ORDER BY mybook.id_book ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    $response = [
      "status" => 200,
      "message" => "success",
      "data" => $rows
    ];
    return json_encode($response);
  }
  public function getLogUsersRead($id_users)
  {
    global $conn;
    $query = "SELECT users.id_users,users.foto,users.username,CONCAT(users.nama_depan,' ',users.nama_belakang) as publisher_name,users.email,book.*,rate_book.id_rate_book,ROUND(AVG(rate_book.rate_score),1) as rate_book,rate_book.comment FROM book LEFT JOIN rate_book ON book.id_book=rate_book.id_book JOIN users ON book.id_users=users.id_users JOIN log_user_read ON log_user_read.id_book=book.id_book WHERE log_user_read.id_users=$id_users GROUP BY log_user_read.id_book";
    $result = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($result);
    if (isset($res)) {
      $response = [
        "status" => 200,
        "message" => "success",
        "data" => $res
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "failed",
      ];
      echo json_encode($response);
    }
  }
  public function check_userLog($id_users)
  {
    global $conn;
    $query = "SELECT * FROM log_user_read where id_users=$id_users";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
  }
  public function insertLogUsersRead()
  {
    global $conn;
    $id_users = $_POST["id_users"];
    $id_book = $_POST["id_book"];

    $query = "INSERT INTO log_user_read (id_users,id_Book) VALUES ('$id_users','$id_book')";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    if (isset($rows)) {
      $response = [
        "status" => 200,
        "message" => "Created",
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "Failed",
      ];
      echo json_encode($response);
    }
  }
  public function updateLogUsersRead()
  {
    global $conn;
    $id_users = $_POST["id_users"];
    $id_book = $_POST["id_book"];

    $query = "UPDATE log_user_read SET id_users=$id_users, id_book=$id_book WHERE id_users=$id_users";
    if (mysqli_query($conn, $query)) {
      $response = [
        "status" => 200,
        "message" => "Updated",
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 400,
        "message" => "Failed",
      ];
      echo json_encode($response);
    }
  }

  public function insertMyBook($transaction_id)
  {
    global $conn;
    $query1 = "INSERT INTO mybook(id_book,id_users) SELECT detail_transaction.id_book, detail_transaction.id_users FROM detail_transaction WHERE detail_transaction.transaction_id='$transaction_id'";
    if (mysqli_query($conn, $query1)) {
      $response = [
        "status" => 200,
        "message" => "Success"
      ];
      echo json_encode($response);
    } else {
      $response = [
        "status" => 401,
        "message" => "Failed"
      ];
      echo json_encode($response);
    }
  }
}
