<?php
require './layout/headerIndex.php';
if ($_SESSION["userdata"]["is-login"] != true) {
  $_SESSION["failed"] = "Login required";
  header("Location: signin.php");
}
require_once './controller/favoriteController.php';
$favorit = new favoriteController();

if (isset($_POST['submit'])) {
  $fav = $favorit->searchFavorite($_POST['keyword'], $_SESSION['userdata']['id_users']);
} else {
  $fav = $favorit->getFavorite($_SESSION['userdata']['id_users']);
}

?>

<section class="book-page" id="Books">
  <div class="sidebar-book">
    <ul>
      <li><a href="books.php">Books</a></li>
      <li><a href="mybooks.php">My Book</a></li>
      <li><a href="favorite.php">Favorite</a></li>
    </ul>
  </div>
  <div class="content-book">
    <h2 class="title">Favorite</h2>
    <span class="subtitle">My Favorite Collection</span>
    <div class="container">
      <div class="search">
        <form action="" method="post">
          <input type="text" name="keyword" id="search" placeholder="Cari buku" class="search-input" autocomplete="off" />
          <button type="submit" name="submit" class="fa-solid fa-search"></button>
        </form>
      </div>

      <div class="book-content">
        <?php if (isset($fav)) :  ?>
          <?php foreach ($fav as $f) : //var_dump($fav);
          ?>
            <div class="card-book" onclick="return window.location.href='<?= BASE_URL ?>detail_book.php?id=<?= $f['id_book'] ?>'">
              <div class="book-cover">
                <div class="book-rate">
                  <i class="fa-solid fa-star"></i>
                  <span><?= $f['rate_book'] ? $f['rate_book'] : "0" ?>/5</span>
                </div>
                <img src="./assets/images/<?= $f['cover']; ?>" alt="" />
              </div>
              <h3 class="book-title"> <?= $f['judul'] ?></h3>
              <span><?= $f['author'] ?></span>
              <h3 class="price"> Rp.<?= number_format($f['harga'], 2) ?></h3>
            </div>

          <?php endforeach ?>
        <?php else : ?>
          <span style="color: grey; margin-left: auto; margin-right: auto; font-size: 20px;">Tidak ada data bernama <b><?= $_POST['keyword']; ?></b></span>
        <?php endif ?>

      </div>
    </div>
  </div>
  </div>
</section>


<?php include_once './layout/footerIndex.php' ?>