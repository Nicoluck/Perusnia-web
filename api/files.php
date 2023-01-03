<?php
require_once('../controller/api/userController.php');
$user = new userController();



if (isset($_GET['file'])) {
  $filename = $_GET['file'];
  $path = BASE_URL . "assets/images/";

  $user->getFiles($filename, $path);
}
