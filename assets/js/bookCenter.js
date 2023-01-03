$(function () {
	$(document).scroll(function () {
		var $nav = $('.navigation');
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});

//datable
$(document).ready(function () {
	$('#table').DataTable();
});

//navabr
$('.navbar-brand').click(function () {
	$('.sidebar-section').toggleClass('hide', 5000);
});

// quiljs
var toolbarOptions = ['bold', 'italic', 'underline', 'clean'];
var editor = new Quill('#text-editor', {
	theme: 'snow',
	modules: {
		toolbar: toolbarOptions,
		clipboard: {
			matchVisual: false,
		},
	},
});

// quiljs passing to $_POST with input hidden
$('#identifier').on('submit', function () {
	var myEditor = document.querySelector('#text-editor');
	var html = myEditor.children[0].innerHTML;
	$('#deskripsi-hidden').val(html);
});

// curency
var currencyInput = document.getElementById('price-book');
var currency = 'IDR'; // https://www.currency-iso.org/dam/downloads/lists/list_one.xml

// format inital value
onBlur({ target: currencyInput });

// bind event listeners
currencyInput.addEventListener('focus', onFocus);
currencyInput.addEventListener('blur', onBlur);

function localStringToNumber(s) {
	return Number(String(s).replace(/[^0-9.-]+/g, ''));
}

function onFocus(e) {
	var value = e.target.value;
	e.target.value = value ? localStringToNumber(value) : '';
}

function onBlur(e) {
	var value = e.target.value;

	var options = {
		maximumFractionDigits: 2,
		currency: currency,
		style: 'currency',
		currencyDisplay: 'symbol',
	};

	e.target.value = value || value === 0 ? localStringToNumber(value).toLocaleString(undefined, options) : '';
}

//sweet alert
function confirmationHapusData(url) {
	Swal.fire({
		title: 'Anda Yakin Untuk Menghapus Buku ini?',
		text: 'Anda tidak akan melihat buku ini lagi!!!',
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
