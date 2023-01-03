$('.owl-carousel').owlCarousel({
	loop: true,
	margin: 10,
	responsiveClass: true,
	responsive: {
		0: {
			items: 1,
			nav: true,
		},
		600: {
			items: 3,
			nav: false,
		},
		1500: {
			items: 5,
			nav: true,
			loop: false,
		},
	},
});
// rating
$('#input-id').rating({
	size: 'xs',
});
