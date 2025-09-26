jQuery(function ($) {
	//Show & Hide Search Main
	$(" .search-maiNav a ").on("click", function (event) {
		event.preventDefault();
		$(".wp-block-group__search").addClass("showz");
	});

	$(".mainSearch-close").on("click", function (event) {
		event.preventDefault();
		$(".wp-block-group__search").removeClass("showz");
	});

	/* ------------------  BACK TO TOP ------------------ */

	const backTop = $("#back-to-top");

	if (backTop.length) {
		const scrollTrigger = 600, // px
			backToTop = function () {
				const scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					backTop.addClass("show");
				} else {
					backTop.removeClass("show");
				}
			};
		backToTop();
		$(window).on("scroll", function () {
			backToTop();
		});
		backTop.on("click", function (e) {
			e.preventDefault();
			$("html,body").animate(
				{
					scrollTop: 0,
				},
				700
			);
		});
	}

	/* ------------------ MAGNIFIC POPUP ------------------ */

	const $imgPopup = $(".img-popup");
	$imgPopup.magnificPopup({
		type: "image",
	});
	$(
		".ghostkit-carousel-items .ghostkit-carousel-slide .wp-block-image a, .img-gallery-item"
	).magnificPopup({
		type: "image",
		gallery: {
			enabled: true,
		},
	});

	/* ------------------  MAGNIFIC POPUP VIDEO ------------------ */

	$(".popup-video a.wp-block-button__link, .popup-gmaps").magnificPopup({
		disableOn: 700,
		mainClass: "mfp-fade",
		removalDelay: 0,
		preloader: false,
		fixedContentPos: false,
		type: "iframe",
		iframe: {
			markup:
				'<div class="mfp-iframe-scaler">' +
				'<div class="mfp-close"></div>' +
				'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
				"</div>",
			patterns: {
				youtube: {
					index: "youtube.com/",
					id: "v=",
					src: "//www.youtube.com/embed/%id%?autoplay=1",
				},
			},
			srcAction: "iframe_src",
		},
	});

	/* ------------------ PROJECTS FLITER ------------------ */

	const $projectFilter = $(".projects-filter"),
		projectLength = $projectFilter.length,
		protfolioFinder = $projectFilter.find("a"),
		$projectAll = $(".projects-all .project-item");

	// init Isotope For project
	protfolioFinder.on("click", function (e) {
		e.preventDefault();
		$projectFilter.find("a.active-filter").removeClass("active-filter");
		$(this).addClass("active-filter");
	});
	if (projectLength > 0) {
		$projectAll.imagesLoaded().progress(function (instance, image) {
			const result = image.isLoaded ? "loaded" : "broken";
			console.log("image is " + result + " for " + image.img.src);
			$projectAll.isotope({
				filter: "*",
				masonry: {
					gutter: 10,
				},
				animationOptions: {
					duration: 750,
					itemSelector: ".hentry",
					easing: "linear",
					queue: false,
				},
			});
		});
	}
	protfolioFinder.on("click", function (e) {
		e.preventDefault();
		const $selector = $(this).attr("data-filter");
		$projectAll
			.imagesLoaded()
			.done(function (instance) {
				console.log("all images successfully loaded");
			})
			.fail(function () {
				console.log("all images loaded, at least one is broken");
			})
			.progress(function () {
				$projectAll.isotope({
					filter: $selector,
					masonry: {
						gutter: 10,
					},
					animationOptions: {
						duration: 750,
						itemSelector: ".hentry",
						easing: "linear",
						queue: false,
					},
				});
				return false;
			});
	});

	/* ------------------  SCROLL TO ------------------ */

	const aScroll = $('a[data-scroll="scrollTo"]');
	aScroll.on("click", function (event) {
		const target = $($(this).attr("href"));
		if (target.length) {
			event.preventDefault();
			$("html, body").animate(
				{
					scrollTop: target.offset().top,
				},
				1000
			);
			if ($(this).hasClass("menu-item")) {
				$(this).parent().addClass("active");
				$(this).parent().siblings().removeClass("active");
			}
		}
	});
});
