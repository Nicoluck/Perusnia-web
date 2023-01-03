<?php
$hostname = "localhost";
$username = "root";
$password = "";
$table = "perusnia";

$conn = mysqli_connect($hostname, $username, $password, $table) or die("Unable to select database: " . mysqli_error($conn));
