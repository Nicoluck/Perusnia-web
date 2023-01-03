<?php
$active = "my_order.php";
require './layout/headerBookCenter.php';

require_once './controller/transactionController.php';
$tran = new transactionController();

if (isset($_GET['transaction_id'])) {
  $trans = $tran->getDetileUserTransaction($_GET['transaction_id']);
}

?>

<h4 class="my-4"><a href="my_order.php" class=" pe-3 btn-back"><i class="fa-solid fa-arrow-left text-dark"></i></a>Detail order</h4>

<div class="card mb-4" style="width: 30rem;">
  <div class="card-header">
    Detile Transaction
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Order id: <?= $trans[0]['order_id']; ?></li>
    <li class="list-group-item">Tipe pembayaran: <?= $trans[0]['payment_type']; ?></li>
    <li class="list-group-item">Virtual account number: <?= $_GET['va_number'] ?></li>
    <li class="list-group-item">Bank: <?= $_GET['bank'] ?></li>
    <li class="list-group-item">Gross amount: Rp. <?= number_format($trans[0]['gross_amount'], 2) ?></li>
    <li class="list-group-item">Transaction time: <?= $trans[0]['transaction_time']; ?></li>
    <li class="list-group-item">Transaction Status: <?= $trans[0]['transaction_status']; ?></li>
    <li class="list-group-item">Settlement time: <?= $trans[0]['settlement_time']; ?></li>
  </ul>
</div>
<div class="card mb-5" style="width: 30rem;">
  <div class="card-header">
    Item order
  </div>
  <ul class="list-group list-group-flush">

    <?php if (isset($trans)) : ?>
      <?php foreach ($trans as $t) : ?>
        <li class="list-group-item">
          <div class="row">
            <div class="col"><?= $t['judul']; ?></div>
            <div class="col text-end">Rp. <?= number_format($t['harga'], 2) ?></div>
          </div>
        </li>
      <?php endforeach ?>
    <?php else : ?>
      <li class="list-group-item">
        <div class="row">
          <div class="col">not found</div>
          <div class="col text-end">0</div>
        </div>
      </li>
    <?php endif ?>
  </ul>
</div>


<?php
require_once './layout/footerBookCenter.php';
?>