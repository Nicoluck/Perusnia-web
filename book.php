<?php
$active = "book.php";
require_once './layout/headerBookCenter.php';

require_once './controller/bookController.php';
$book = new bookController();
$topRatedBook = $book->getTopRateBook();
?>

<h4 class="my-4">Top rated book</h4>
<div class="owl-carousel">
  <?php if (isset($topRatedBook)) :  ?>
    <?php foreach ($topRatedBook as $b) : ?>
      <div class="product-item">
        <div class="product-img">
          <img src="./assets/images/<?= $b['cover']; ?>" alt="" class="img-fluid d-block mx-auto">
        </div>

        <div class="product-info p-3">
          <span class="product-type"><?= $b['author']; ?></span>
          <a href="detail_book.php?id=<?= $b['id_book']; ?>" class="d-block text-dark text-decoration-none py-2 product-name"><?= $b['judul']; ?></a>
          <span class="product-price">Rp. <?= number_format($b['harga'], 2) ?></span>
          <div class="mt-1">
            <input id="input-id" type="text" class="rating" data-size="xs" value="<?= $b['rate_book']; ?>" readonly>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php else : ?>
    <h5 class="text-muted">Data kosong</h5>
  <?php endif ?>
</div>

<h4 class="my-4">Some book</h4>
<div class="owl-carousel">
  <?php if ($book->getAllbook() != null) :  ?>
    <?php foreach ($book->getAllbook() as $b) : ?>
      <div class="product-item">
        <div class="product-img">
          <img src="./assets/images/<?= $b['cover']; ?>" alt="" class="img-fluid d-block mx-auto">
        </div>

        <div class="product-info p-3">
          <span class="product-type"><?= $b['author']; ?></span>
          <a href="detail_book.php?id=<?= $b['id_book']; ?>" class="d-block text-dark text-decoration-none py-2 product-name"><?= $b['judul']; ?></a>
          <span class="product-price">Rp. <?= number_format($b['harga'], 2) ?></span>
          <div class="mt-1">
            <input id="input-id" type="text" class="rating" data-size="xs" value="<?= $b['rate_book']; ?>" readonly>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php else : ?>
    <h5 class="text-muted">Data kosong</h5>
  <?php endif ?>
</div>


<?php require './layout/footerBookCenter.php' ?>