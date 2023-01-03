$(function () {
	$(document).scroll(function () {
		var $nav = $('.navigation');
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});

$(document).ready(function () {
	$('#table').DataTable();
});

$('.darkbg').click(function () {
	$('.signup').hide();
	$('.signin').hide();
	$(this).fadeOut(1000);
});

function confirmationHapusData(url) {
	Swal.fire({
		title: 'Anda Yakin Untuk Menghapus?',
		text: 'Data ini akan terhapus!!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Hapus Saja!!',
		closeOnConfirm: false,
	}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
}

$('#input-id').rating();
$('#input-id').rating({
	size: 'xs',
	showClear: false,
});
