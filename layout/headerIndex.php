<?php
require_once './root/base_url.php';
require_once './controller/userController.php';
require_once './controller/ContactController.php';
require_once './controller/cartController.php';
$cart_root = new cartController();
$contact = new ContactController();
$user =  new userController;

$data2 = $contact->index();

if (isset($_SESSION['userdata']['id_users'])) {
    $item_total = $cart_root->getItemPriceTotal($_SESSION['userdata']['id_users']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/cart.css" />
    <script src="./assets/fontawesome/fontawesome.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <title>Perusnia Books</title>
    <link rel="icon" href="" type="image/icon type" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-iIMWCUVAqp4mewuM"></script>


    <!-- rating -->
    <!-- default styles -->

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>


</head>

<body>
    <nav class="navigation index" id="navigation">
        <div class="container">
            <span class="navbar-brand"><a href="index.php">PERUSNIA BOOK</a></span>
            <ul class="navbar">
                <li class="nav-link"><a href="index.php">Home</a></li>
                <li class="nav-link"><a href="about.php">About</a></li>
                <li class="nav-link"><a href="books.php">Books</a></li>
                <?php if (isset($_SESSION['userdata']['is-login'])) : ?>
                    <li class="nav-link cart-btn">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping badge" value="<?= $item_total['total_item']; ?>+"></i></a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['userdata']['is-login'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= isset($user->getUserById($_SESSION['userdata']['id_users'])['foto']) ? "./assets/images/" . $user->getUserById($_SESSION['userdata']['id_users'])['foto'] : "./assets/images/default_image.png" ?>" class="rounded-circle img-nav" width="40" alt="" srcset="" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-light bg-white mt-2">
                            <li><a class="dropdown-item" href="<?= $_SESSION['userdata']['id_level'] == 1 ? 'dashboard_admin.php' : 'book.php' ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-link"><a href="signin.php" class="sign-in">Sign In</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>


    <!-- whatassppp buble -->
    <span class="whatsapp-buble"><a href="https://api.whatsapp.com/send?phone=<?= $data2['telepon'] ?>&text=Halo%20saya%20ingin%20bertanya%20mengenai%20perusnia" target="_blank" class="fa-brands fa-4x fa-square-whatsapp"></a></span>
    <!-- whatassppp buble -->