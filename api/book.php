<?php
require_once('../controller/api/bookController.php');
$user = new bookController();


if (isset($_GET['id_users'])) {
  echo $user->getBookUsersById($_GET['id_users']);
} elseif (isset($_GET['id_book'])) {
  echo $user->getBookById($_GET['id_book']);
} else {
  echo $user->index();
}
