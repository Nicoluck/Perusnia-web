<?php
require './layout/headerIndex.php';
require_once './controller/AboutController.php';
require_once './controller/GaleryController.php';
require_once './controller/ContactController.php';
$about = new AboutController();
$data = $about->index();
$galeri = new GaleryController();
$data1 = $galeri->index();
$contact = new ContactController();
$data2 = $contact->index();
?>

<section class="about-page" id="about">
	<h2 class="title">About</h2>
	<span class="subtitle">My Company</span>
	<div class="container">
		<div class="img-about">
			<img src="<?= $data['foto_about'] ? "./assets/images/" . $data['foto_about'] : "./assets/images/default_image.png" ?>" alt="foto perusnia">
			<!--<img src="./assets/images/galeri1.jpeg" alt="" />-->
		</div>
		<div class="desc-about">
			<p><?= $data['isi_about'] ?></p>
			<!--<p>Museum perusnia adalah sebuah tempat wisata uang kuno yang berlokasi di bangkalan, yang di dirikan 2 januari 2021 oleh seorang pemuda yang berumur 21 tahun. Tidak hanya memamerkan koleksi uang kunonya, dia juga menulis beberapa buku sejarah tentang uang kuno seluruh dunia. Tujuan Salman Alrosyid menulis sebuah buku mengenai sejarah uang koin Indonesia agar masyarakat dan pegiat kolektor uang mudah memahami sejarah penggunaan mata uang koin Indonesia, selain menunjang kegiatan numismatic, buku ini menjadi pengembagan pengetahuan mengenai sejarah penggunaan uang koin di Indonesia dahulu.</p>-->
		</div>
	</div>
</section>
<section class="galeri" id="galeri">
	<h2 class="title">Galeri</h2>
	<span class="subtitle">Galey from perusnia</span>
	<div class="container">
		<?php foreach ($data1 as $d1) : ?>
			<div class="card-img-galeri">
				<img src="./assets/images/<?= $d1['foto'] ?>" alt="kumpulan foto museum perusnia" />
				<div class="card-img-text">
					<p><?= $d1['deskripsi'] ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<?php include_once './layout/footerIndex.php' ?>