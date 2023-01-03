<?php
require './layout/headerIndex.php';

require_once './controller/bookController.php';
require_once './controller/feedbackController.php';
require_once './controller/favoriteController.php';
require_once './controller/cartController.php';
require_once './assets/midtrans-php-master/Midtrans.php';

$book = new bookController();
$feedback = new feedbackController();
$favorite = new favoriteController();
$cart = new cartController();


if ($book->getSpesiificBook($_GET['id'])) {
	$bok = $book->getSpesiificBook($_GET['id']);
}
if ($feedback->getAllRatebook($_GET['id'])) {
	$feed = $feedback->getAllRatebook($_GET['id']);
}

if (isset($_POST['submit-feedback'])) {
	if ($feedback->insert($_SESSION['userdata']['id_users'], $bok['id_book']) > 0) {
		header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
		echo "<div style='background-color: green; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;'>Fedback added</div>";
	} else {
		header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
		echo "<div style='background-color: red; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;'>Fedback Failed</div>";
	}
}
if (isset($_POST['update-feedback'])) {
	if ($feedback->update($_SESSION['userdata']['id_users'], $bok['id_book']) > 0) {
		header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
		echo "<div style='background-color: green; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;'>Fedback updated</div>";
	} else {
		header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
		echo "<div style='background-color: red; padding: 20px; color: #FFFFFF; margin-bottom: 10px; border-radius: 5px; opacity: 50%;'>Fedback update Failed</div>";
	}
}


if (isset($_SESSION['userdata']['id_users'])) {
	$favo = $favorite->getSpesificFavorite($_SESSION['userdata']['id_users'], $bok['id_book']);




	// Set your Merchant Server Key
	\Midtrans\Config::$serverKey = 'SB-Mid-server-rNXSy1soppSKk2C96hFzfjjg';
	// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
	\Midtrans\Config::$isProduction = false;
	// Set sanitization on (default)
	\Midtrans\Config::$isSanitized = true;
	// Set 3DS transaction for credit card to true
	\Midtrans\Config::$is3ds = true;

	$user_detile = $user->getUserById($_SESSION['userdata']['id_users']);

	$id_transaction = "PERUSNIA-" . uniqid();

	if (isset($_SESSION['userdata']['id_users']) && $bok['harga'] != 0) {
		$transaction_details = array(
			'order_id' => $id_transaction,
			'gross_amount' => $bok['harga'], // no decimal allowed for creditcard
		);



		$item_details[0]['id'] = $bok['id_book'];
		$item_details[0]['price'] = $bok['harga'];
		$item_details[0]['quantity'] = 1;
		$item_details[0]['name'] = $bok['judul'];


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
}



?>

<section class="container detile-book">
	<div class="row">
		<div class="col col1 book-identity">
			<ul>
				<li class="book-title"><?= $bok['judul']; ?></li>
				<li class="book-author"><?= $bok['author']; ?></li>
				<li class="book-tgl"><?= date("d M Y", strtotime($bok['publication_date'])) ?></li>
				<li class="status-book">
					<ul>
						<li>
							<ul class="rating">
								<li class="title"><?= isset($bok['rate_book']) ? $bok['rate_book'] : "0.0" ?><i class="fa-solid fa-star"></i></li>
								<li class="subtitle"><?= isset($feed) ? count($feed) : "0"  ?> reviews</li>
							</ul>
						</li>
						<li>
							<ul class="pages">
								<li class="title"><?= $bok['halaman']; ?></li>
								<li class="subtitle">Pages</li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="book-button">
					<ul>
						<li>
							<?php
							if (isset($_SESSION['userdata']['id_users'])) :
								$cek_mybook = $book->check_mybook($_SESSION['userdata']['id_users'], $bok['id_book']); ?>
								<?php if ($cek_mybook > 0 || $bok['harga'] == 0) : ?>
									<a href="viewPDF.php?file=<?= $bok["file_buku"]; ?>" target="_blank" class="btn btn-buy">Read this book</a>
								<?php else : ?>
									<a href="#" id="pay-button" style="cursor: pointer;" class="btn btn-buy">IDR. <?= number_format($bok['harga'], 2) ?></a>
								<?php endif ?>
							<?php else : ?>
								<a style="cursor: pointer;" onclick="alert('login required'); window.location.href='<?= BASE_URL ?>signin.php';" class="btn btn-buy">IDR. <?= number_format($bok['harga'], 2) ?></a>
							<?php endif ?>
						</li>
						<li>
							<?php if (isset($_SESSION['userdata']['id_users'])) : ?>
								<?php if ($book->check_mybook($_SESSION['userdata']['id_users'], $bok['id_book']) > 0) : ?>
									<a style="cursor: pointer" onclick="alert('Anda telah memiliki buku ini!!')" class="btn btn-cart"><i class="fa-solid fa-cart-shopping"></i></a>
								<?php else : ?>
									<a style="cursor: pointer" onclick=" addToCart()" class="btn btn-cart"><i class="fa-solid fa-cart-shopping"></i></a>
								<?php endif ?>
							<?php else : ?>
								<a style="cursor: pointer" onclick="alert('login required'); window.location.href='<?= BASE_URL ?>signin.php';" class="btn btn-cart"><i class="fa-solid fa-cart-shopping"></i></a>
							<?php endif ?>
						</li>
						<li>
							<?php if (isset($_SESSION['userdata']['id_users'])) : ?>
								<?php if ($favo > 0) : ?>
									<a style="cursor: pointer;" onclick="btn_favorite()" class="btn btn-favorite"><i class="fa-solid fa-heart" style="color: red;"></i></a>
								<?php else : ?>
									<a style="cursor: pointer;" onclick="btn_favorite()" class="btn btn-favorite"><i class="fa-solid fa-heart"></i></a>
								<?php endif ?>
							<?php else : ?>
								<a style="cursor: pointer;" onclick="alert('login Required !!'); window.location.href = '<?= BASE_URL ?>signin.php';" class="btn btn-favorite"><i class="fa-solid fa-heart"></i></a>
							<?php endif ?>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="col col2">
			<div class="book-cover">
				<img src="./assets/images/<?= $bok['cover']; ?>" alt="">
			</div>
		</div>
	</div>
</section>

<section class="container desc-book ">
	<div class="row">
		<div class="col col1">
			<p class="section-title">About this book</p>
			<p><?= $bok['description']; ?></p>

			<?php if (isset($_SESSION['userdata']['id_users'])) : ?>
				<?php $yb = $feedback->getSpesificRateBook($_SESSION['userdata']['id_users'], $bok['id_book']); ?>
				<?php if ($feedback->cek_feedback($_SESSION['userdata']['id_users'], $bok['id_book']) < 1) : ?>
					<?php if ($book->check_mybook($_SESSION['userdata']['id_users'], $bok['id_book']) > 0) : ?>
						<div class="your-feedback">
							<p class="section-title">Your Feedback</p>
							<form action="" method="post">
								<input id="input-id" type="text" class="rating" data-size="sm" name="rate_score" value="">
								<textarea name="comment" id="" cols="40" rows="4" placeholder="Send Feedback"></textarea>
								<input type="submit" name="submit-feedback" value="Send Feedback" class="btn-send-feedback">
							</form>
						</div>
					<?php endif ?>
				<?php else : ?>
					<div class="your-feedback">
						<p class="section-title">Your feedback</p>
						<form action="" method="post" class="form-update-feedback" style="display: none;">
							<input id=" input-id" type="text" class="rating" data-size="sm" name="rate_score" value="">
							<textarea name="comment" id="" cols="40" rows="4" placeholder="Send Feedback"></textarea>
							<div class="" style="display: flex; align-items: center; gap: 10px;">
								<input type="submit" name="update-feedback" value="Update Feedback" class="btn-send-feedback">
								<a class="btn-cancel-update-feedback">Cencel</a>
							</div>
						</form>
						<div class="feedback" id="your-feedback">
							<ul>
								<li class="rating-profile">
									<ul>
										<li class="rating-image">
											<img src="./assets/images/<?= $yb['foto']; ?>" alt="">
										</li>
										<li class="rating-name-rt">
											<ul>
												<li class="rating-name"><?= $yb['nama_lengkap']; ?></li>
												<li class="rating-rt-tgl">
													<ul>
														<li class="rating"> <input id="input-id" type="text" class="rating" data-size="xs" value="<?= $yb['rate_score']; ?>" readonly></li>
														<li class="rating-tgl"><?= date("d/m/Y", strtotime($yb['created_at'])) ?></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="feedback"><?= $yb['comment']; ?></li>
								<li>
									<div style="display: flex; align-items: center; margin-top: 5px;">
										<a id="show-update-form" class="btn-update-feedback">Update Feedback</a>
										<a class="btn-delete-feedback" onclick="return confirm('Apakah anda yakin?')?deleteFeedback():'';">Delete Feedback</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				<?php endif ?>
			<?php endif ?>

			<p class="section-title">Some feedback</p>
			<?php if (isset($feed)) : ?>
				<?php foreach (($feed) as $b) : ?>
					<div class="feedback">
						<ul>
							<li class="rating-profile">
								<ul>
									<li class="rating-image">
										<img src="./assets/images/<?= $b['foto']; ?>" alt="">
									</li>
									<li class="rating-name-rt">
										<ul>
											<li class="rating-name"><?= $b['nama_lengkap']; ?></li>
											<li class="rating-rt-tgl">
												<ul>
													<li class="rating"> <input id="input-id" type="text" class="rating" data-size="xs" value="<?= $b['rate_score']; ?>" readonly></li>
													<li class="rating-tgl"><?= date("d/m/Y", strtotime($b['created_at'])) ?></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="feedback"><?= $b['comment']; ?></li>
						</ul>
					</div>
				<?php endforeach ?>
			<?php else : ?>
				<span style="color: grey;">Feedback not found</span>
			<?php endif ?>


		</div>
		<div class="col col2">
		</div>
	</div>
</section>

<script src="./assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$('.btn-update-feedback').click(function() {
		$('.form-update-feedback').toggle();
		$('#your-feedback').hide();
	});
	$('.btn-cancel-update-feedback').click(function() {
		$('.form-update-feedback').toggle();
		$('#your-feedback').show();
	});

	function deleteFeedback() {
		$.get("<?= BASE_URL ?>api/deleteFeedback.php?api_key=fasih123", {
			id_users: <?= $_SESSION['userdata']['id_users'] ?>,
			id_book: <?= $bok['id_book']; ?>
		}).done(function(data) {
			alert("Feedback deleted!!");
			location.reload();
		});
	}

	function btn_favorite() {
		<?php if ($favo > 0) : ?>
			$.post("<?= BASE_URL ?>api/deleteFavoriteBook.php?api_key=fasih123", {
				id_book: <?= $bok['id_book'] ?>,
				id_users: <?= $_SESSION['userdata']['id_users'] ?>,
			}).done(function(data) {
				alert('Book deleted from favorite!!');
				location.reload();
			}).fail(function() {
				alert('Book failed to deleted from favorite!!');
				location.reload();
			});
		<?php else : ?>
			$.post("<?= BASE_URL ?>api/insertFavoriteBook.php?api_key=fasih123", {
				id_book: <?= $bok['id_book'] ?>,
				id_users: <?= $_SESSION['userdata']['id_users'] ?>,
			}).done(function(data) {
				alert('Book added to favorite!!');
				location.reload();
			}).fail(function() {
				alert('Book failed added to favorite!!');
				location.reload();
			});
		<?php endif ?>
	}

	function addToCart() {
		$.post("<?= BASE_URL ?>api/cart_item.php?api_key=fasih123", {
			id_users: <?= $_SESSION['userdata']['id_users'] ?>,
			id_book: <?= $bok['id_book'] ?>,
		}).done(function(data) {
			alert('Added to cart');
			location.reload();
		}).fail(function() {
			alert('has been added to cart');
			location.reload();
		});
	}

	// midtrasn
	var payButton = document.getElementById('pay-button');
	payButton.addEventListener('click', function() {
		// Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
		window.snap.pay('<?= $snapToken; ?>', {
			onSuccess: function(result) {

				$.post("<?= BASE_URL ?>api/insertDetaileTransaction.php?api_key=fasih123", {
					transaction_id: result.transaction_id,
					id_users: <?= $_SESSION['userdata']['id_users'] ?>,
					id_book: <?= $bok['id_book']; ?>
				});


				$.get("<?= BASE_URL ?>api/cart_item.php?api_key=fasih123", {
					id_users: <?= $_SESSION['userdata']['id_users'] ?>,
					id_book: <?= $bok['id_book']; ?>
				});

				$.get("<?= BASE_URL ?>api/insertMyBook.php?api_key=fasih123", {
					transaction_id: result.transaction_id,
				});

				alert("payment success!");
				location.reload();
				console.log(result);
			},
			onPending: function(result) {

				$.post("<?= BASE_URL ?>api/insertDetaileTransaction.php?api_key=fasih123", {
					transaction_id: result.transaction_id,
					id_users: <?= $_SESSION['userdata']['id_users'] ?>,
					id_book: <?= $bok['id_book']; ?>
				});


				$.get("<?= BASE_URL ?>api/cart_item.php?api_key=fasih123", {
					id_users: <?= $_SESSION['userdata']['id_users'] ?>,
					id_book: <?= $bok['id_book']; ?>
				});


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


<?php
unset($_SESSION['alert']);
include_once './layout/footerIndex.php';
?>