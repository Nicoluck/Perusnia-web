<?php
if (!isset($_GET['api_key'])) {
  $response = [
    "status" => 401,
    "message" => "api_key required"
  ];
  echo json_encode($response);
  die;
} else {
  //api_key_client
  $api_key = md5($_GET['api_key']);

  $query = "SELECT * FROM api";
  $result = mysqli_query($conn, $query);
  //api_key_from_database
  while ($row = mysqli_fetch_assoc($result)) {
    $keys[] = $row["api_key"];
  }

  //CHECK API_KEY
  if (!in_array($api_key, $keys)) {
    $response = [
      "status" => 401,
      "message" => "api_key is invalid"
    ];
    echo json_encode($response);
    die;
  }
}
