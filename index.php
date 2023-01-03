<?php require './layout/headerIndex.php';
require_once './controller/AboutController.php';
require_once './controller/ContactController.php';
require_once './controller/bookController.php';
$about = new AboutController();
$data = $about->index();
$contact = new ContactController();
$data2 = $contact->index();
$book = new bookController();
$bok = $book->getTopRateBook3();
?>

<div class="image-banner">
	<div class="container">
		<div class="text-image">
			<div class="row">
				<div class="col text-banner">
					<h2>PERUSNIA BOOK</h2>
					<span>Aplikasi baca buku digital dan jual beli buku bagi penulis agar dapat bermanfaat pada masayarat khusunya masyarakat indonesia </span>
					<div class="button-search">
						<input type="text" name="search" placeholder="Cari buku" />
						<input type="submit" name="submit" value="Cari" />
					</div>
				</div>
				<div class="col img-banner">
					<img src="./assets/images/book.png" alt="" class="book-mockup" />
				</div>
			</div>
		</div>
	</div>
</div>
<section class="about" id="about">
	<h2 class="title">About</h2>
	<span class="subtitle">My Company</span>
	<div class="container">
		<div class="img-about">
			<img src="<?= $data['foto_about'] ? "./assets/images/" . $data['foto_about'] : "./assets/images/default_image.png" ?>" alt="foto perusnia">
			<!--<img src="./assets/images/galeri1.jpeg" alt="" />-->
		</div>
		<div class="desc-about">
			<?= $data['isi_about'] ?>
			<!--<p>Museum perusnia adalah tempat wisata uang kuno yang berlokasi di bangkalan, yang di dirikan 2 januari 2021 oleh seorang pemuda yang berumur 21 tahun. Tidak hanya memamerkan koleksi uang kunonya, dia juga menulis beberapa buku sejarah tentang uang kuno seluruh dunia. Tujuan Salman Alrosyid menulis sebuah buku mengenai sejarah uang koin Indonesia agar masyarakat dan pegiat kolektor uang mudah memahami sejarah penggunaan mata uang koin Indonesia, selain menunjang kegiatan numismatic, buku ini menjadi pengembagan pengetahuan mengenai sejarah penggunaan uang koin di Indonesia dahulu.</p>-->
			<a href="about.php">More info <i class="fa-solid fa-arrow-right"></i></a>
		</div>
	</div>
</section>
<section class="books" id="books">
	<h2 class="title">Top Rated Book</h2>
	<span class="subtitle">Book Collection</span>
	<div class="container">
		<?php if (isset($bok)) : ?>
			<?php foreach ($bok as $b) : ?>
				<div class="card-book">
					<div class="book-cover">
						<div class="book-rate">
							<i class="fa-solid fa-star"></i>
							<span><?= $b['rate_book']; ?>/5</span>
						</div><a href="detail_book.php?id=<?= $b['id_book'] ?>"><img src="./assets/images/<?= $b['cover'] ?>" alt="" /></a>
					</div>
					<h3 class="book-title"><a href="detail_book.php?id=<?= $b['id_book'] ?>"><?= $b['judul'] ?></a></h3>
					<span><?= $b['author'] ?></span>
					<h3 class="price">Rp. <?= number_format($b['harga'], 2) ?></h3>
					<a href="" class="btn"><span class="fa-solid fa-shopping-cart"></span> Add to cart</a>
				</div>
			<?php endforeach; ?>
		<?php else : ?>

		<?php endif ?>

		<div class="card-book more">
			<a href="books.php" class="">More Book <i class="fa-solid fa-chevron-right"></i></a>
		</div>
	</div>
</section>
<section class="testimoni" id="testimoni">
	<h2 class="title">Testimoni</h2>
	<span class="subtitle">Other people's response</span>
	<div class="container">
		<div class="card-testimoni">
			<div class="rate-testimoni"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
			<div class="card-text">Tempatnyua nyaman, koleksi uangnya sangat lengkap dan salah satu musium terlengkap seluruh dunia</div>
			<div class="card-profile">
				<div class="profile-image">
					<img src="./assets/images/p1.png" alt="" />
				</div>
				<div class="profile-name">
					<b>Herlambang</b>
					<span>Penggemar Uang Kuno</span>
				</div>
			</div>
		</div>
		<div class="card-testimoni">
			<div class="rate-testimoni"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
			<div class="card-text">Tempatnyua nyaman, koleksi uangnya sangat lengkap dan salah satu musium terlengkap seluruh dunia</div>
			<div class="card-profile">
				<div class="profile-image">
					<img src="./assets/images/p1.png" alt="" />
				</div>
				<div class="profile-name">
					<b>Herlambang</b>
					<span>Penggemar Uang Kuno</span>
				</div>
			</div>
		</div>
		<div class="card-testimoni">
			<div class="rate-testimoni"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
			<div class="card-text">Tempatnyua nyaman, koleksi uangnya sangat lengkap dan salah satu musium terlengkap seluruh dunia</div>
			<div class="card-profile">
				<div class="profile-image">
					<img src="./assets/images/p1.png" alt="" />
				</div>
				<div class="profile-name">
					<b>Herlambang</b>
					<span>Penggemar Uang Kuno</span>
				</div>
			</div>
		</div>
	</div>
</section>



<?php require './layout/footerIndex.php' ?>