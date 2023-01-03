<?php
require './controller/bookController.php';
require './controller/dashboardController.php';
require './controller/userController.php';
$dashboard =  new dashboardController;
$bookCatalog =  new bookController;
$user = new userController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Bootstrap % Fontawesome -->
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/style1.css">
  <link rel="stylesheet" href="./assets/css/adminpanel.css" />
  <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap % Fontawesome -->
  <!-- datatables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <!-- datatables -->

  <!-- quill editor -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <!-- quill editor -->

  <!-- slider -->


  <!-- owl carousel -->
  <link rel="stylesheet" href="./assets/owl_carousel/owl.carousel.css">
  <link rel="stylesheet" href="./assets/owl_carousel/owl.theme.default.css">
  <!-- custom css -->


  <!-- rating -->
  <!-- default styles -->

  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>
  <title>Perusnia Book Center</title>
</head>

<body>
  <section class="container-fluid">
    <div class="row">
      <!-- navigation -->
      <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><i class="fa-solid fa-bars px-2 pe-4"></i> </i> Perusnia Book Center</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?= isset($user->getUserById($_SESSION['userdata']['id_users'])['foto']) ? "./assets/images/" . $user->getUserById($_SESSION['userdata']['id_users'])['foto'] : "./assets/images/default_image.png" ?>" class="rounded-circle img-nav" width="40" alt="" srcset="" />
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-light bg-white mt-2">
                  <li><a class="dropdown-item" href="index.php">Home</a></li>
                  <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                  <li><a class="dropdown-item text-danger" href="logout.php">Sign Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- navigation -->
    </div>
    <div class="row section-admin-panel">
      <div class="col-md-2 sidebar-section hide bg-white border-end">
        <div class="sidebar-profile">
          <img src="<?= isset($user->getUserById($_SESSION['userdata']['id_users'])['foto']) ? "./assets/images/" . $user->getUserById($_SESSION['userdata']['id_users'])['foto'] : "./assets/images/default_image.png" ?>" class="rounded-circle" width="50" alt="" />
          <div class="profile-status">
            <strong><?= $user->getUserById($_SESSION['userdata']['id_users'])['username'] ?></strong>
            <span><i class="fa-solid fa-circle fa-2xs text-success"></i> Online</span>
          </div>
        </div>

        <ul class="navbar-nav menus navbar-side">

          <?php if ($_SESSION["userdata"]['id_level'] == 1) : ?>

            <li class="nav-item">
              <a href="dashboard_admin.php" class="nav-link <?= $active ==  "dashboard_admin.php" ? 'active' : '' ?>"><i class="fa-solid fa-chart-line"></i> Dashboard Admin</a>
            </li>
            <li class="nav-item">
              <a href="<?= $bookCatalog->index()['view']; ?>" class="nav-link <?= $active ==  "bookCatalog.php" ? 'active' : '' ?>"><i class="fa-solid fa-book"></i> Book Catalog</a>
            </li>
            <div class="dropdown">
              <a class="nav-link <?= $active ==  "about_website.php" ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-gears"></i>
                About Website
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="edit_about.php">About</a></li>
                <li><a class="dropdown-item" href="galeri.php">Galeri</a></li>
                <li><a class="dropdown-item" href="contact_input.php">Contact</a></li>
              </ul>
            </div>
            <li class="nav-item">
              <a href="setting.php" class="nav-link <?= $active ==  "setting.php" ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i> Setting Account</a>
            </li>

          <?php elseif ($_SESSION["userdata"]['id_level'] == 2) : ?>

            <li class="nav-item">
              <a href="book.php" class="nav-link <?= $active ==  "book.php" ? 'active' : '' ?>"><i class="fa-solid fa-book"></i> Book</a>
            </li>
            <li class="nav-item">
              <a href="my_book.php" class="nav-link <?= $active ==  "my_book.php" ? 'active' : '' ?>"><i class="fa-solid fa-book-reader"></i> My Book</a>
            </li>
            <li class="nav-item">
              <a href="favorite_book.php" class="nav-link <?= $active ==  "favorite_book.php" ? 'active' : '' ?>"><i class="fa-solid fa-heart"></i> Favorite book</a>
            </li>
            <li class="nav-item">
              <a href="my_order.php" class="nav-link <?= $active ==  "my_order.php" ? 'active' : '' ?>"><i class="fa-solid fa-credit-card"></i> My Order</a>
            </li>
            <li class="nav-item">
              <a href="setting.php" class="nav-link <?= $active ==  "setting.php" ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i> Setting Account</a>
            </li>

          <?php endif ?>

        </ul>
      </div>
      <div class="col-md px-5 content-section ">

        <div class="row">
          <div class="content">
            <div class="container ">