<?php
require_once('../controller/api/userController.php');
$user = new userController();


if (isset($_GET['id_users'])) {
  echo $user->getUserById($_GET['id_users']);
} else {
  echo $user->index();
}
