<?php require './layout/headerIndex.php';
require_once './controller/ContactController.php';
require_once './controller/bookController.php';
$contact = new ContactController();
$data2 = $contact->index();
$book = new bookController();


if (isset($_POST["submit"])) {
	$bok = $book->cari($_POST['search']);
} else {
	$bok = $book->getAllbook();
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
		<h2 class="title">Books</h2>
		<span class="subtitle">Books Collection</span>
		<div class="container">
			<div class="search">
				<form action="" method="post">
					<input type="text" name="search" id="search" placeholder="Cari buku" class="search-input" autocomplete="off" />
					<button type="submit" name="submit" class="fa-solid fa-search"></button>
				</form>
			</div>
			<div class="book-content">
				<?php if (isset($bok)) : ?>
					<?php foreach ($bok as $b) : ?>
						<div class="card-book" onclick="return window.location.href='<?= BASE_URL ?>detail_book.php?id=<?= $b['id_book'] ?>'">
							<div class="book-cover">
								<div class="book-rate">
									<i class="fa-solid fa-star"></i>
									<span><?= $b['rate_book'] ? $b['rate_book'] : "0" ?>/5</span>
								</div><img src="./assets/images/<?= $b['cover'] ?>" alt="cover_buku" />
							</div>
							<h3 class="book-title"><a href="detail_book.php?id=<?= $b['id_book'] ?>"><?= $b['judul'] ?></a></h3>
							<span><?= $b['author'] ?></span>
							<h3 class="price">Rp. <?= number_format($b['harga'], 2) ?></h3>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<span style="color: grey; margin-left: auto; margin-right: auto; font-size: 20px;">Tidak ada data bernama <b><?= $_POST['search']; ?></b></span>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>


<?php include_once './layout/footerIndex.php';
?>