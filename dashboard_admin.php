<?php
session_start();
if ($_SESSION["userdata"]["id_level"] != 1) {
  header('Location:404.php');
}
$active = "dasbhaord_admin.php";
require_once './layout/headerBookCenter.php';
require_once './controller/dashboardController.php';
$dsb = new dashboardController();

$asd = $dsb->transactionTotalPerMonth();
if (isset($asd)) {
  for ($i = 0; $i < count($dsb->transactionTotalPerMonth()); $i++) {
    $total[$i] = $dsb->transactionTotalPerMonth()[$i]['total'];
  }

  for ($i = 0; $i < count($dsb->transactionTotalPerMonth()); $i++) {
    $bulan[$i] = date('F', mktime(0, 0, 0, $dsb->transactionTotalPerMonth()[$i]['bulan'], 10));
  }
}


?>


<h4 class="my-4">Dashboard Admin</h4>
<div class="row justify-content-center" style="display: flex; gap: 100px;">

  <div class="card border-success mb-3" style="max-width: 18rem; width: 20rem; text-align: center">
    <div class="card-header">Book total</div>
    <div class="card-body text-success px-5 py-5 fs-1 bg-light">
      <p class="card-text"><?= $dsb->book_total() ?></p>
    </div>
  </div>



  <div class="card border-success mb-3" style="max-width: 18rem; width: 20rem; text-align: center">
    <div class="card-header">Users total</div>
    <div class="card-body text-success px-5 py-5 fs-1 bg-light">
      <p class="card-text"><?= $dsb->user_total(); ?></p>
    </div>
  </div>



  <div class="card border-success mb-3" style="max-width: 18rem; width: 20rem; text-align: center">
    <div class="card-header">Transaction in <?= date("F") ?></div>
    <div class="card-body text-success px-5 py-5 fs-1 bg-light">
      <p class="card-text"><?= $dsb->transaction_total(); ?></p>
    </div>
  </div>


</div>

<div class="row justify-content-center text-center text-muted">
  <h5>Transaction chart <?= date("Y") ?></h5>
  <div id="chart"></div>

</div>

<?php if (isset($asd)) : ?>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script type="text/javascript">
    var options = {
      chart: {
        type: 'line'
      },
      series: [{
        name: 'Price',
        data: [
          <?php for ($i = 0; $i < count($total); $i++) : ?>
            <?= json_encode($total[$i]) . "," ?>
          <?php endfor ?>
        ]
      }],
      xaxis: {
        categories: [
          <?php for ($i = 0; $i < count($bulan); $i++) : ?>
            <?= json_encode($bulan[$i]) . "," ?>
          <?php endfor ?>
        ]
      },
      colors: ['#027333', '#027333', '#027333']
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
  </script>
<?php endif ?>

<?php require './layout/footerBookCenter.php' ?>