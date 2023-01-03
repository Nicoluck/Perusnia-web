<?php
require './controller/AuthController.php';
$auth = new AuthController;

$auth->signout();
