<?php
require_once './layout/headerIndex.php';
require_once './controller/cartController.php';
require_once './controller/userController.php';
require_once './assets/midtrans-php-master/Midtrans.php';
$cart = new cartController();

if ($_SESSION["userdata"]["is-login"] != true) {
    $_SESSION["failed"] = "Login required";
    header("Location: signin.php");
}




// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-rNXSy1soppSKk2C96hFzfjjg';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$gross_ammount = $cart->getItemPriceTotal($_SESSION['userdata']['id_users']);
$user_detile = $user->getUserById($_SESSION['userdata']['id_users']);
$detile_item = $cart->getCartItemById($_SESSION['userdata']['id_users']);


$id_transaction = "PERUSNIA-" . uniqid();

if (isset($detile_item)) {
    $transaction_details = array(
        'order_id' => $id_transaction,
        'gross_amount' => $gross_ammount['total_harga'], // no decimal allowed for creditcard
    );


    for ($i = 0; $i < count($detile_item); $i++) {
        $item_details[$i]['id'] = $detile_item[$i]['id_book'];
        $item_details[$i]['price'] = $detile_item[$i]['harga'];
        $item_details[$i]['quantity'] = 1;
        $item_details[$i]['name'] = $detile_item[$i]['judul'];
    }

    $billing_address = array(
        'first_name'    => $user_detile['nama_depan'],
        'last_name'     => $user_detile['nama_belakang'],
        'address'       => "-",
        'city'          => "-",
        'postal_code'   => "-",
        'phone'         => $user_detile['no_telp'],
        'country_code'  => 'IDN'
    );

    // Optional
    $shipping_address = array(
        'first_name'    => $user_detile['nama_depan'],
        'last_name'     => $user_detile['nama_belakang'],
        'address'       => "-",
        'city'          => "-",
        'postal_code'   => "-",
        'phone'         => $user_detile['no_telp'],
        'country_code'  => 'IDN'
    );

    $customer_details = array(
        'first_name'    => $user_detile['nama_depan'],
        'last_name'     => $user_detile['nama_belakang'],
        'email'         => $user_detile['email'],
        'phone'         => $user_detile['no_telp'],
        'billing_address'  => $billing_address,
        'shipping_address' => $shipping_address
    );

    $params = array(
        'transaction_details' => $transaction_details,
        'item_details' => $item_details,
        'customer_details' => $customer_details
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);
}

?>
<section class="cart">
    <div class="container cart-page">

        <h2>Cart</h2>
        <?php if (isset($_SESSION['alert']['success'])) : ?>
            <div style="background-color: green; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;"><?= $_SESSION['alert']['success']; ?></div>
        <?php elseif (isset($_SESSION['alert']['failed'])) : ?>
            <div style="background-color: red; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;"><?= $_SESSION['alert']['failed']; ?></div>
        <?php endif ?>
        <div class="project">
            <div class="shop">
                <?php if ($cart->getCartItemById($_SESSION['userdata']['id_users']) != null) : ?>
                    <?php foreach ($cart->getCartItemById($_SESSION['userdata']['id_users']) as $c) : ?>
                        <div class="box">
                            <img src="./assets/images/<?= $c['cover']; ?>">
                            <div class="content">
                                <h4><?= $c['judul']; ?></h4>
                                <p><?= $c['author']; ?></p>
                                <p>Rate: <?= $c['rate_book']; ?></p>
                                <h4 class="unit">Rp.<?= number_format($c['harga'], 2) ?></h4>
                                <p class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span onclick="if (confirm('apakah anda yakin ingin menghapus?')) window.location.href='deleteCart.php?id_users=<?= $_SESSION['userdata']['id_users']; ?>&id_book=<?= $c['id_book']; ?>';" class="btn2">Remove</span></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

                <?php
                if ($cart->getCartItemById($_SESSION['userdata']['id_users']) != null) {
                    $total = array_sum(array_column($cart->getCartItemById($_SESSION['userdata']['id_users']), 'harga'));
                }
                ?>
            </div>
            <div class="right-bar">
                <form action="" method="post">
                    <div class="form-grup">
                        <label for="subtotal">subtotal item</label>
                        <input type="text" name="subtotal_item" value="Rp. <?= isset($total) ? number_format($total, 2) : "" ?>" disabled>
                    </div>
                    <div class="form-grup">
                        <label for="pajak">subtotal diskon</label>
                        <input type="text" name="subtotal_diskon" value="Rp. 0,0" disabled>
                    </div>
                    <div class="form-grup">
                        <label for="pengirirman">total pembayaran</label>
                        <input type="text" name="total_pembayaran" value="Rp. <?= isset($total) ? number_format($total, 2) : "" ?>" disabled>
                    </div>
                </form>
                <a href="#" name="submit" id="pay-button"><i class="fas badge fa-shopping-cart"></i>Checkout</a>
            </div>
        </div>
    </div>
</section>

<?php unset($_SESSION['alert']) ?>

<script src="./assets/js/jquery.min.js"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('<?= $snapToken; ?>', {
            onSuccess: function(result) {
                <?php if (isset($detile_item)) : ?>
                    <?php for ($i = 0; $i < count($detile_item); $i++) : ?>
                        $.post("<?= BASE_URL ?>api/insertDetaileTransaction.php?api_key=fasih123", {
                            transaction_id: result.transaction_id,
                            id_users: <?= $_SESSION['userdata']['id_users'] ?>,
                            id_book: <?= $detile_item[$i]['id_book']; ?>
                        });
                    <?php endfor ?>

                    $.get("<?= BASE_URL ?>api/deleteAllCartUsers.php?api_key=fasih123", {
                        id_users: <?= $_SESSION['userdata']['id_users'] ?>,
                    });


                    $.get("<?= BASE_URL ?>api/insertMyBook.php?api_key=fasih123", {
                        transaction_id: result.transaction_id,
                    });

                <?php endif ?>




                alert("payment success!");
                location.reload();
                console.log(result);
            },
            onPending: function(result) {
                <?php if (isset($detile_item)) : ?>

                    <?php for ($i = 0; $i < count($detile_item); $i++) : ?>
                        $.post("<?= BASE_URL ?>api/insertDetaileTransaction.php?api_key=fasih123", {
                            id_users: <?= $detile_item[$i]['id_users']; ?>,
                            id_book: <?= $detile_item[$i]['id_book']; ?>
                        });
                    <?php endfor ?>

                    $.get("<?= BASE_URL ?>api/deleteAllCartUsers.php?api_key=fasih123", {
                        id_users: <?= $_SESSION['userdata']['id_users'] ?>,
                    });
                <?php endif ?>

                alert("wating your payment!");
                location.reload();
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });
</script>
<?php include_once './layout/footerIndex.php'; ?>