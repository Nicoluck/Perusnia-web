<?php
$active = "my_order.php";
require './layout/headerBookCenter.php';

require_once './controller/transactionController.php';
$tran = new transactionController();

if (isset($_SESSION['userdata']['id_users'])) {
  $trans = $tran->getUserTransaction($_SESSION['userdata']['id_users']);
}
?>

<h4 class="my-4">My order history</h4>

<div class="table-responsive py-3">
  <table class="table table-hover align-middle " id="table">
    <thead class="bg-default shadow-sm">
      <tr>
        <th>No</th>
        <th>Order ID</th>
        <th>Payment Method</th>
        <th>Amount</th>
        <th>Status Transaction</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($trans)) : ?>
        <?php $no = 1;
        foreach ($trans as $t) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $t['order_id']; ?></td>
            <td><?= $t['payment_type']; ?></td>
            <td>Rp. <?= number_format($t['gross_amount'], 2) ?></td>
            <?php if ($t['transaction_status'] == "settlement") : ?>
              <td><span class="bg-success text-white rounded-pill p-1">Success</span></td>
            <?php else : ?>
              <td><span class="bg-secondary text-white rounded-pill p-1"><?= $t['transaction_status'] ?></span></td>
            <?php endif ?>
            <td>
              <a href="detile_order.php?transaction_id=<?= $t['transaction_id']; ?>&va_number=<?= $t['va_number']; ?>&bank=<?= $t['bank']; ?>" class="btn btn-light "><i class="fa-solid fa-eye"></i></a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
      <?php endif ?>

    </tbody>
  </table>
</div>

<?php
require_once './layout/footerBookCenter.php';
?>