(function ($) {
	"use strict";
	var TelnetCore = {
		init: function () {
			this.Basic.init();
		},

		Basic: {
			init: function () {
				this.allAddClass();
				this.mobileMenu();
				this.activatePlugin();
				this.customFunction();
				this.telnetQuantity();
				this.galleryPostSlider();
				this.scrollTop();
			},

			allAddClass: function () {
				// side info active
				$("[data-txSideInfoTrigger]").on("click", function (e) {
					e.preventDefault();
					$("[data-txSideInfoWrapper]").addClass("is-open");
					$("[data-txOverlay]").addClass("is-open");
				});

				$("[data-txMiniCartTrigger]").on("click", function (e) {
					e.preventDefault();
					$("[data-txMiniCartWrapper]").addClass("is-open");
					$("[data-txOverlay]").addClass("is-open");
				});

				// remove active class from mobile-menu
				$("[data-txClose], [data-txOverlay]").on("click", function (e) {
					e.preventDefault();
					$("[data-txOverlay]").removeClass("is-open");
					$("[data-txSideInfoWrapper]").removeClass("is-open");
					$("[data-txMiniCartWrapper]").removeClass("is-open");
				});

				$("body").on("added_to_cart", function () {
					$("[data-txOverlay]").addClass("is-open");
					$("[data-txMiniCartWrapper]").addClass("is-open");
				});

				// search popup active
				if ($("[data-tx-searchTrigger]").length) {
					$("[data-tx-searchTrigger]").on("click", function () {
						$("[data-txSearchPopupWrapper]").addClass("is-open");
						$("[data-txOverlay]").addClass("is-open");
					});
					$("[data-search-close], [data-txOverlay]").on(
						"click",
						function () {
							$("[data-txSearchPopupWrapper]").removeClass(
								"is-open"
							);
							$("[data-txOverlay]").removeClass("is-open");
						}
					);
				}

				// menu last elements add class
				$("#tx-navbar > ul > li").slice(-2).addClass("last-elements");
			},

			mobileMenu: function () {
				// active mobile-menu
				jQuery("#tx-navbar").meanmenu({
					meanScreenWidth: "1199",
					meanMenuContainer: ".tx-mobileMmenu",
					meanExpand: ["<i>+</i>"],
				});
			},
			activatePlugin: function () {
				// Activate lightcase
				$("a[data-rel^=lightcase]").lightcase();

				// niceSelect active
				if ($("select").length) {
					$("select").niceSelect();
				}
			},
			customFunction: function () {
				// copyright year with condition
				function copyRightYear() {
					let currentYear = new Date().getFullYear();
					if (document.getElementById("copyright-date")) {
						document.getElementById("copyright-date").innerHTML =
							currentYear;
					}
				}
				copyRightYear();

				// background image js
				function background() {
					var img = $("[data-background]");
					img.css("background-image", function () {
						var bg = "url(" + $(this).data("background") + ")";

						if ($(this).data("background")) {
							return bg;
						} else {
							return false;
						}
					});
				}
				background();
			},
			telnetQuantity: function () {
				function handleQuantityChange(element, step) {
					var qty = element
						.closest(".tx-input-plus-minus")
						.find(".qty");
					var val = parseFloat(qty.val());
					var max = parseFloat(qty.attr("max"));
					var min = parseFloat(qty.attr("min"));

					// Calculate the new value based on the step and button type
					var newValue = $(element).hasClass("plus")
						? val + step
						: val - step;

					// Ensure the new value is within the valid range
					if ((max && newValue > max) || (min && newValue < min)) {
						return;
					}

					qty.val(newValue).trigger("change");
				}

				$(".tx-input-plus-minus").append(`
					<div class="tx-qty-btn-wrapper d-flex align-items-center justify-content-center">
					<span class="tx-qty-btn plus d-flex">
						<i class="fas fa-caret-up"></i>
					</span>
					<span class="tx-qty-btn minus d-flex">
						<i class="fas fa-caret-down"></i>
					</span>
					</div>
				`);

				$(".tx-input-plus-minus").on(
					"click",
					".tx-qty-btn.plus, .tx-qty-btn.minus",
					function () {
						var step = parseFloat(
							$(this)
								.closest(".tx-input-plus-minus")
								.find(".qty")
								.attr("step")
						);
						handleQuantityChange($(this), step);
					}
				);
			},
			galleryPostSlider: function () {
				// blog slider active
				var txPostGallery = new Swiper("[data-txPostGallery]", {
					spaceBetween: 0,
					slidesPerView: 1,
					effect: "fade",
					loop: true,
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
						clickable: true,
					},
					autoplay: {
						enabled: true,
						delay: 6000,
					},
				});
			},
			scrollTop: function () {
				$(window).on("scroll", function () {
					if ($(this).scrollTop() > 200) {
						$(".tx-scrollup").fadeIn();
					} else {
						$(".tx-scrollup").fadeOut();
					}
				});

				$(".tx-scrollup").on("click", function () {
					$("html, body").animate(
						{
							scrollTop: 0,
						},
						800
					);
					return false;
				});
			},
			StickyHeader: function () {
				jQuery(window).on("scroll", function () {
					if (jQuery(window).scrollTop() > 250) {
						jQuery(
							".tx-header__styleDefault.header_style_four"
						).addClass("sticky-on");
					} else {
						jQuery(
							".tx-header__styleDefault.header_style_four"
						).removeClass("sticky-on");
					}
				});
				jQuery(document).ready(function (o) {
					0 < o(".navSidebar-button").length &&
						o(".navSidebar-button").on("click", function (e) {
							e.preventDefault(),
								e.stopPropagation(),
								o(".info-group").addClass("isActive");
						}),
						0 < o(".close-side-widget").length &&
							o(".close-side-widget").on("click", function (e) {
								e.preventDefault(),
									o(".info-group").removeClass("isActive");
							}),
						o(".xs-sidebar-widget").on("click", function (e) {
							e.stopPropagation();
						});
				});
				$(".search-btn").on("click", function () {
					$(".search-body").toggleClass("search-open");
				});
				$(document).ready(function () {
					$(".cart_close_btn, .body-overlay").on(
						"click",
						function () {
							$(".cart_sidebar").removeClass("active");
							$(".body-overlay").removeClass("active");
						}
					);

					$(".header-cart-btn").on("click", function () {
						$(".cart_sidebar").addClass("active");
						$(".body-overlay").addClass("active");
					});
				});
			},
			TwinMax: function () {
				var $circleCursor = $(".cursor");

				function moveCursor(e) {
					var t = e.clientX + "px",
						a = e.clientY + "px";
					TweenMax.to($circleCursor, 0.2, {
						left: t,
						top: a,
						ease: "Power1.easeOut",
					});
				}

				function zoomCursor(e) {
					TweenMax.to($circleCursor, 0.1, {
						scale: 3,
						ease: "Power1.easeOut",
					}),
						$($circleCursor).removeClass("cursor-close");
				}

				function closeCursor(e) {
					TweenMax.to($circleCursor, 0.1, {
						scale: 3,
						ease: "Power1.easeOut",
					}),
						$($circleCursor).addClass("cursor-close");
				}

				function defaultCursor(e) {
					TweenLite.to($circleCursor, 0.1, {
						scale: 1,
						ease: "Power1.easeOut",
					}),
						$($circleCursor).removeClass("cursor-close");
				}
				$(window).on("mousemove", moveCursor),
					$("a, button, .zoom-cursor").on("mouseenter", zoomCursor),
					$(".trigger-close").on("mouseenter", closeCursor),
					$(
						"a, button, .zoom-cursor, .trigger-close, .trigger-plus"
					).on("mouseleave", defaultCursor);
			},
			TelNetAnimation: function () {
				gsap.registerPlugin(
					ScrollTrigger,
					ScrollSmoother,
					TweenMax,
					ScrollToPlugin
				);
				gsap.config({
					nullTargetWarn: false,
				});
				let splitTitleLines = gsap.utils.toArray(".headline-title");
				splitTitleLines.forEach((splitTextLine) => {
					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: splitTextLine,
							start: "top 90%",
							end: "bottom 60%",
							scrub: false,
							markers: false,
							toggleActions: "play none none none",
						},
					});
					const itemSplitted = new SplitText(splitTextLine, {
						type: "words, lines",
					});
					gsap.set(splitTextLine, { perspective: 400 });
					itemSplitted.split({ type: "lines" });
					tl.from(itemSplitted.lines, {
						duration: 1,
						delay: 0.3,
						opacity: 0,
						rotationX: -80,
						force3D: true,
						transformOrigin: "top center -50",
						stagger: 0.1,
					});
				});
			},
			TitleAnimation: function () {
				$(document).ready(function () {
					var st = $(".tx-split-text");
					if (st.length == 0) return;
					gsap.registerPlugin(SplitText);
					st.each(function (index, el) {
						el.split = new SplitText(el, {
							type: "lines,words,chars",
							linesClass: "split-line",
						});
						gsap.set(el, { perspective: 400 });

						if ($(el).hasClass("split-in-fade")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								ease: "Back.easeOut",
							});
						}
						if ($(el).hasClass("split-in-right")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								x: "50",
								ease: "Back.easeOut",
							});
						}
						if ($(el).hasClass("split-in-left")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								x: "-50",
								ease: "circ.out",
							});
						}
						if ($(el).hasClass("split-in-up")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								y: "80",
								ease: "circ.out",
							});
						}
						if ($(el).hasClass("split-in-down")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								y: "-80",
								ease: "circ.out",
							});
						}
						if ($(el).hasClass("split-in-rotate")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								rotateX: "50deg",
								ease: "circ.out",
							});
						}
						if ($(el).hasClass("split-in-scale")) {
							gsap.set(el.split.chars, {
								opacity: 0,
								scale: "0.5",
								ease: "circ.out",
							});
						}
						el.anim = gsap.to(el.split.chars, {
							scrollTrigger: {
								trigger: el,
								start: "top 90%",
							},
							x: "0",
							y: "0",
							rotateX: "0",
							scale: 1,
							opacity: 1,
							duration: 0.8,
							stagger: 0.02,
						});
					});
				});
				let splitTextLines = gsap.utils.toArray(".telnet-text p");

				splitTextLines.forEach((splitTextLine) => {
					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: splitTextLine,
							start: "top 90%",
							duration: 2,
							end: "bottom 60%",
							scrub: false,
							markers: false,
							toggleActions: "play none none none",
						},
					});

					const itemSplitted = new SplitText(splitTextLine, {
						type: "lines",
					});
					gsap.set(splitTextLine, { perspective: 400 });
					itemSplitted.split({ type: "lines" });
					tl.from(itemSplitted.lines, {
						duration: 1,
						delay: 0.5,
						opacity: 0,
						rotationX: -80,
						force3D: true,
						transformOrigin: "top center -50",
						stagger: 0.1,
					});
				});
				$(window).on("load", function () {
					const boxes = gsap.utils.toArray(
						".tx-animation-style1,.tel-img-animation"
					);
					boxes.forEach((img) => {
						gsap.to(img, {
							scrollTrigger: {
								trigger: img,
								start: "top 70%",
								end: "bottom bottom",
								toggleClass: "active",
								once: true,
							},
						});
					});
				});
			},
		},
	};

	jQuery(document).ready(function () {
		TelnetCore.init();
	});

	$(window).on("load", function () {
		$("#tx-preloader").fadeOut("slow", function () {
			$(this).remove();
		});

		$(".tx-mobileMmenu ul li a").on("click", function (e) {
			$("[data-txOverlay]").removeClass("is-open");
			$("[data-txSideInfoWrapper]").removeClass("is-open");
			$("[data-txMiniCartWrapper]").removeClass("is-open");
		});
	});

	jQuery(".video_box").magnificPopup({
		disableOn: 200,
		type: "iframe",
		mainClass: "mfp-fade",
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false,
	});

	jQuery(window).on("scroll", function () {
		if (jQuery(window).scrollTop() > 250) {
			jQuery(".tx-header").addClass(
				"sticky-on"
			);
		} else {
			jQuery(".tx-header").removeClass(
				"sticky-on"
			);
		}
	});

	jQuery(window).on("scroll", function () {
		if (jQuery(window).scrollTop() > 250) {
			jQuery(".tx-header__styleDefault.header_style_five").addClass(
				"sticky-on"
			);
		} else {
			jQuery(".tx-header__styleDefault.header_style_five").removeClass(
				"sticky-on"
			);
		}
	});

	jQuery(window).on("scroll", function () {
		if (jQuery(window).scrollTop() > 250) {
			jQuery(".tx-header__styleDefault.header_style_six").addClass(
				"sticky-on"
			);
		} else {
			jQuery(".tx-header__styleDefault.header_style_six").removeClass(
				"sticky-on"
			);
		}
	});

	jQuery(window).on("scroll", function () {
		if (jQuery(window).scrollTop() > 250) {
			jQuery(".main-header").addClass("fixed-header");
		} else {
			jQuery(".main-header").removeClass("fixed-header");
		}
	});

	// Services Carousel
	function serviceTwoSlider($scope, $) {
		if ($(".services_carousel").length) {
			$(".services_carousel").owlCarousel({
				//animateOut: 'fadeOut',
				//animateIn: 'fadeIn',
				loop: false,
				//merge:true,
				margin: 20,
				//autoWidth:true,
				nav: true,
				//autoHeight: true,
				smartSpeed: 500,
				autoplay: 6000,
				autoplayTimeout: 5000000,
				navText: [
					'<span class="fa-regular fa-arrow-left-long"></span>',
					'<span class="fa-regular fa-arrow-right-long"></span>',
				],
				responsive: {
					0: {
						items: 1,
					},
					600: {
						items: 1,
					},
					800: {
						items: 2,
					},
					992: {
						items: 2,
					},
					1024: {
						items: 2,
					},
					1200: {
						items: 2,
					},
				},
			});
		}
	}

	function progressActive($scope, $) {
		if ($(".count-box").length) {
			$(".count-box").appear(
				function () {
					var $t = $(this),
						n = $t.find(".count-text").attr("data-stop"),
						r = parseInt(
							$t.find(".count-text").attr("data-speed"),
							10
						);

					if (!$t.hasClass("counted")) {
						$t.addClass("counted");
						$({
							countNum: $t.find(".count-text").text(),
						}).animate(
							{
								countNum: n,
							},
							{
								duration: r,
								easing: "linear",
								step: function () {
									$t.find(".count-text").text(
										Math.floor(this.countNum)
									);
								},
								complete: function () {
									$t.find(".count-text").text(this.countNum);
								},
							}
						);
					}
				},
				{ accY: 0 }
			);
		}

		if ($(".progress-line").length) {
			$(".progress-line").appear(
				function () {
					var el = $(this);
					var percent = el.data("width");
					$(el).css("width", percent + "%");
				},
				{ accY: 0 }
			);
		}
	}

	//LightBox / Fancybox
	if ($(".lightbox-image").length) {
		$(".lightbox-image").fancybox({
			openEffect: "fade",
			closeEffect: "fade",
			helpers: {
				media: {},
			},
		});
	}

	function counterActive($scope, $) {
		if ($(".odometer").length) {
			$(".odometer").appear();
			$(".odometer").appear(function () {
				var odo = $(".odometer");
				odo.each(function () {
					var countNumber = $(this).attr("data-count");
					$(this).html(countNumber);
				});
				window.odometerOptions = {
					format: "d",
				};
			});
		}
	}

	if ($(".tabs-box").length) {
		$(".tabs-box .tab-buttons .tab-btn").on("click", function (e) {
			e.preventDefault();
			var target = $($(this).attr("data-tab"));

			if ($(target).is(":visible")) {
				return false;
			} else {
				target
					.parents(".tabs-box")
					.find(".tab-buttons")
					.find(".tab-btn")
					.removeClass("active-btn");
				$(this).addClass("active-btn");
				target
					.parents(".tabs-box")
					.find(".tabs-content")
					.find(".tab")
					.fadeOut(0);
				target
					.parents(".tabs-box")
					.find(".tabs-content")
					.find(".tab")
					.removeClass("active-tab");
				$(target).fadeIn(300);
				$(target).addClass("active-tab");
			}
		});
	}

	if ($(".spotlight-tab").length) {
		$(".spotlight-tab .product-tab-btns .p-tab-btn").on(
			"click",
			function (e) {
				e.preventDefault();
				var target = $($(this).attr("data-tab"));

				if ($(target).hasClass("actve-tab")) {
					return false;
				} else {
					$(
						".spotlight-tab .product-tab-btns .p-tab-btn"
					).removeClass("active-btn");
					$(this).addClass("active-btn");
					$(".spotlight-tab .p-tabs-content .p-tab").removeClass(
						"active-tab"
					);
					$(target).addClass("active-tab");
				}
			}
		);
	}

	function moviePosterActive($scope, $) {
		//Parallax Scene for Icons
		if ($(".parallax-scene-1").length) {
			var scene = $(".parallax-scene-1").get(0);
			var parallaxInstance = new Parallax(scene);
		}
		if ($(".parallax-scene-2").length) {
			var scene = $(".parallax-scene-2").get(0);
			var parallaxInstance = new Parallax(scene);
		}
		if ($(".parallax-scene-3").length) {
			var scene = $(".parallax-scene-3").get(0);
			var parallaxInstance = new Parallax(scene);
		}
		if ($(".parallax-scene-4").length) {
			var scene = $(".parallax-scene-4").get(0);
			var parallaxInstance = new Parallax(scene);
		}
	}

	//Update Header Style and Scroll to Top
	function headerStyle() {
		if ($(".main-header").length) {
			var windowpos = $(window).scrollTop();
			var siteHeader = $(".main-header");
			var scrollLink = $(".scroll-to-top");

			var HeaderHight = $(".main-header").height();
			if (windowpos >= HeaderHight) {
				siteHeader.addClass("fixed-header");
				scrollLink.fadeIn(300);
			} else {
				siteHeader.removeClass("fixed-header");
				scrollLink.fadeOut(300);
			}
		}
	}
	headerStyle();

	if ($(".mobile-menu").length) {
		$(".mobile-menu .menu-box").mCustomScrollbar();

		var mobileMenuContent = $(".main-header .nav-outer .main-menu").html();
		$(".mobile-menu .menu-box .menu-outer").append(mobileMenuContent);
		$(".sticky-header .main-menu").append(mobileMenuContent);

		//Dropdown Button
		$(".mobile-menu li.dropdown .dropdown-btn").on("click", function () {
			$(this).toggleClass("open");
			$(this).prev("ul").slideToggle(500);
		});

		//Menu Toggle Btn
		// $(".mobile-nav-toggler").on("click", function () {
		// 	$("body").addClass("mobile-menu-visible");
		// });

		//Menu Toggle Btn
		$(".mobile-menu .menu-backdrop,.mobile-menu .close-btn").on(
			"click",
			function () {
				$("body").removeClass("mobile-menu-visible");
			}
		);
	}

	// home 7 js start

	/*
    mobile-menu
    ====start====
    */

	// $(".mobile-nav-toggler").on("click", function () {
	// 	$("body").addClass("mobile-menu-visible");
	// });

	$(".menu-backdrop , .close-btn").on("click", function () {
		$("body").removeClass("mobile-menu-visible");
	});

	function testimonialFourActive($scope, $) {
		let tnatestimonial1 = new Swiper(".tna_t1_slider_active", {
			loop: true,
			spaceBetween: 0,
			speed: 1000,
			rtl: false,
			slidesPerView: 1,
			autoplay: {
				delay: 5000,
			},
			pagination: {
				el: ".tna-t1-pagination",
				clickable: true,
			},
		});
		let tnat2_thumb = new Swiper(".tna_testimonial_2_preview_active", {
			spaceBetween: 25,
			loop: false,
			speed: 1000,
			slidesPerView: 3,
			direction: "vertical",
			rtl: false,
			centeredSlides: false,
			watchSlidesProgress: false,

			breakpoints: {
				320: {
					slidesPerView: 2,
					direction: "horizontal",
				},
				576: {
					slidesPerView: 3,
					direction: "horizontal",
				},
				768: {
					slidesPerView: 3,
					direction: "horizontal",
				},
				992: {
					slidesPerView: 3,
					direction: "horizontal",
				},
				1200: {
					slidesPerView: 3,
					direction: "vertical",
				},
			},
		});

		let tnat2 = new Swiper(".tna_testimonial_2_active", {
			loop: true,
			spaceBetween: 0,
			rtl: false,
			slidesPerView: 1,
			effect: "fade",
			autoplay: {
				delay: 3000,
			},
			fadeEffect: {
				crossFade: true,
			},
			thumbs: {
				swiper: tnat2_thumb,
			},
		});
	}

	// movie list slider
	function movieListSliderActive($scope, $) {
		var tna_movie_2_active = new Swiper(".tna_movie_2_active", {
			loop: true,
			spaceBetween: 25,
			speed: 1000,
			centeredSlides: true,
			autoplay: {
				delay: 5000,
			},
			navigation: {
				nextEl: ".tna_movie_2_next",
				prevEl: ".tna_movie_2_prev",
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 3,
				},
			},
		});
	}

	// hero section slider 3 active
	function heroSliderThreeActive($scope, $) {
		let tnah3 = new Swiper(".tna_hero_3_active", {
			loop: true,
			spaceBetween: 0,
			rtl: false,
			slidesPerView: 1,
			effect: "fade",
			navigation: {
				nextEl: ".tna_hero_3_next",
				prevEl: ".tna_hero_3_prev",
			},
			autoplay: {
				delay: 4000,
			},
			fadeEffect: {
				crossFade: true,
			},
		});
	}

	// seervice 3 slider active
	function serviceThreeSliderActive($scope, $) {
		let tnas3 = new Swiper(".tna_services_3_active", {
			loop: true,
			spaceBetween: 30,
			rtl: false,
			navigation: {
				nextEl: ".tna_services_3_next",
				prevEl: ".tna_services_3_prev",
			},
			autoplay: {
				delay: 4000,
			},

			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 4,
				},
			},
		});
	}

	// price 3 active
	function priceThreeActive($scope, $) {
		var swiper = new Swiper(".tna_price_3_main", {
			loop: true,
			spaceBetween: 50,
			speed: 500,
			slidesPerView: 3,
			navigation: {
				nextEl: ".price-button-next",
				prevEl: ".price-button-prev",
			},
			breakpoints: {
				1400: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 3,
				},
				576: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
		var swiper2 = new Swiper(".tna_price_3_preview", {
			loop: true,
			spaceBetween: 10,
			effect: "fade",
			navigation: {
				nextEl: ".price-button-next",
				prevEl: ".price-button-prev",
			},
			thumbs: {
				swiper: swiper,
			},
		});
	}

	// testimonail 3 active
	function testimonialThreeActive($scope, $) {
		let tnat3 = new Swiper(".tna_t3_active", {
			loop: true,
			spaceBetween: 0,
			speed: 1000,
			rtl: false,
			slidesPerView: 1,
			effect: "fade",
			autoplay: {
				delay: 5000,
			},
			fadeEffect: {
				crossFade: true,
			},
			navigation: {
				nextEl: ".tna_t3_next",
				prevEl: ".tna_t3_prev",
			},
		});
	}

	// gallery 3 active
	function galleryThreeActive($scope, $) {
		let tnafollow = new Swiper(".tna_follower_active", {
			loop: true,
			rtl: false,
			speed: 500,
			autoplay: {
				delay: 4000,
			},

			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 2,
				},
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 4,
				},
				992: {
					slidesPerView: 5,
				},
				1200: {
					slidesPerView: 6,
				},
			},
		});
	}

	// movie poster tab active
	function moviePosterTabActive($scope, $) {
		$('.js-marquee-wrapper').marquee({
			speed: 100,
			gap: 0,
			delayBeforeStart: 0,
			direction: 'left',
			duplicated: false,
			pauseOnHover: true,

		  })
	}

	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	$(".popup_img").magnificPopup({
		type: "image",
		gallery: {
			enabled: true,
		},
	});

	function bgImage($scope, $) {
		$("[tna-data-background]").each(function () {
			$(this).css(
				"background-image",
				"url(" + $(this).attr("tna-data-background") + ") "
			);
		});
	}

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	// faq 2 js start
	$(document).on("click", ".accordion-item", function () {
		$(this).addClass("tna_faq2_bg").siblings().removeClass("tna_faq2_bg");
	});

	var backtotop = $(".scroll-top");

	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			backtotop.addClass("show");
		} else {
			backtotop.removeClass("show");
		}
	});

	backtotop.on("click", function (e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "700");
	});

	// Active wow js
	new WOW().init();

	function chanelSliderActive($scope, $) {
		var tnac2 = new Swiper(".tna_channel_2_active", {
			loop: true,
			speed: 1000,
			autoplay: {
				delay: 5000,
			},

			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 2,
				},
				576: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 4,
				},
				992: {
					slidesPerView: 5,
				},
			},
		});
	}

	// --------------------animation-start-----------------------------

	gsap.registerPlugin(ScrollTrigger);

	/*
	add-class
	====start====
	*/
	const txaaddclass = gsap.utils.toArray(".txa-class-add");
	txaaddclass.forEach((img) => {
		gsap.to(img, {
			scrollTrigger: {
				trigger: img,
				scrub: 1,
				start: "top 80%",
				end: "bottom bottom",
				toggleClass: "active",
				toggleActions: "play none none reverse",
				once: true,
			},
		});
	});

	document.addEventListener("mousemove", parallax);
	function parallax(e) {
		document.querySelectorAll(".object").forEach(function (move) {
			var moving_value = move.getAttribute("data-value");
			var x = (e.clientX * moving_value) / 250;
			var y = (e.clientY * moving_value) / 250;

			move.style.transform =
				"translateX(" + x + "px) translateY(" + y + "px)";
		});
	}

	$(".tna-blog-2-item").on("mouseover", function () {
		var current_class = document.getElementsByClassName(
			"tna-blog-2-item active"
		);
		current_class[0].className = current_class[0].className.replace(
			" active",
			""
		);
		this.className += " active";
	});

	/*
	add-class
	====end====
	*/

	/*
		stiky-slider-start
	*/
	function raceWrapper($scope, $) {
		const races = document.querySelector(".races");

		function getScrollAmount() {
			let racesWidth = races.scrollWidth;
			return -(racesWidth - window.innerWidth);
		}

		const tween = gsap.to(races, {
			x: getScrollAmount,
			duration: 3,
			ease: "none",
		});

		ScrollTrigger.create({
			trigger: ".racesWrapper",
			start: "top 10%",
			end: () => `+=${getScrollAmount() * -1}`,
			pin: true,
			animation: tween,
			scrub: 1,
			invalidateOnRefresh: true,
			markers: false,
		});
	}

	/*
		stiky-slider-end
	*/

	gsap.utils.toArray(" .txa-slide-left").forEach((el, index) => {
		let tl2 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 3,
				start: "top 80%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl2.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 0, x: "-=500" },
			{ opacity: 1, x: 0, duration: 1, immediateRender: true }
		);
	});

	gsap.utils.toArray(" .txa-slide-right").forEach((el, index) => {
		let tl3 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 3,
				start: "top 80%",
				end: "top 70%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl3.set(el, { transformOrigin: "center center" }).from(
			el,
			{ opacity: 0, x: "+=500" },
			{ opacity: 1, x: 0, duration: 1, immediateRender: false }
		);
	});

	// active zoomOut animation
	gsap.utils.toArray('.txa-zoomout').forEach((el, index) => {
		let tl4 = gsap.timeline({
		  scrollTrigger: {
			trigger: el,
		  scrub: 1,
			start: "top 80%",
		  end: "buttom 50%",
			toggleActions: "play none none reverse",
			 markers: false
		  }
		})

		tl4
		.set(el, {transformOrigin: 'center center'})
		.from(el, {  scale: 2, }, {scale: 1,  duration: 1, immediateRender: true})
	  })

	//
	function moviePosterTwo($scope, $) {
		if ($(window).width() > 991) {
			gsap.utils.toArray(".txa-slide-up").forEach((el, index) => {
				let tl5 = gsap.timeline({
					scrollTrigger: {
						trigger: el,
						scrub: 1,
						start: "top 90%",
						end: "top 0%",
						toggleActions: "play none none reverse",
						markers: false,
					},
				});

				tl5.set(el, { transformOrigin: "center center" }).from(
					el,
					{ y: 0 },
					{ y: 0, duration: 1, immediateRender: false }
				);
			});

			gsap.utils.toArray(".txa-slide-down").forEach((el, index) => {
				let tl6 = gsap.timeline({
					scrollTrigger: {
						trigger: el,
						scrub: 1,
						start: "top 40%",
						end: "top -80%",
						toggleActions: "play none none reverse",
						markers: false,
					},
				});

				tl6.set(el, { transformOrigin: "center center" }).from(
					el,
					{ y: -500 },
					{ y: 0, duration: 1, immediateRender: false }
				);
			});
		}
	}

	gsap.utils.toArray(".tna-channel-1-img").forEach((el, index) => {
		let tl7 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 1,
				start: "top 90%",
				end: "top 60%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl7.set(el, { transformOrigin: "center center" }).from(
			el,
			{ y: "+=500" },
			{ y: 0, duration: 1, immediateRender: false }
		);
	});

	function ctaActive($scope, $) {
		gsap.utils
			.toArray(".tna-discount-1-img , .tna-d1-ani-shpae")
			.forEach((el, index) => {
				let tl8 = gsap.timeline({
					scrollTrigger: {
						trigger: el,
						scrub: 1,
						start: "top 80%",
						end: "top 50%",
						toggleActions: "play none none reverse",
						markers: false,
					},
				});

				tl8.set(el, { transformOrigin: "center center" }).from(
					el,
					{ x: "-=300" },
					{ x: 0, duration: 1, immediateRender: false }
				);
			});
	}

	function newsletterActive($scope, $) {
		gsap.utils.toArray(".tna-form-1-wrap").forEach((el, index) => {
			let tl9 = gsap.timeline({
				scrollTrigger: {
					trigger: el,
					scrub: 1,
					start: "top 80%",
					end: "top 40%",
					toggleActions: "play none none reverse",
					markers: false,
				},
			});

			tl9.set(el, { transformOrigin: "center center" }).from(
				el,
				{ scale: 0.5 },
				{ scale: 1, duration: 1, immediateRender: true }
			);
		});

		gsap.utils.toArray(".tna-touch-title-2").forEach((el, index) => {
			let tl10 = gsap.timeline({
				scrollTrigger: {
					trigger: el,
					scrub: 1,
					start: "top 70%",
					end: "top 40%",
					toggleActions: "play none none reverse",
					markers: false,
				},
			});

			tl10.set(el, { transformOrigin: "center center" }).from(
				el,
				{ color: "#E10419" },
				{ color: "#fff", duration: 1, immediateRender: true }
			);
		});
	}

	function blogSticky($scope, $) {
		if ($(window).width() > 1199) {
			ScrollTrigger.create({
				trigger: ".tna-blog-1-area",
				start: "top top",
				end: "bottom bottom",
				pin: ".tna-blog-1-content",
			});
		}
	}

	function tna_opacity($scope, $) {
		gsap.utils.toArray(".tna-opacity").forEach((el, index) => {
			let tl11 = gsap.timeline({
				scrollTrigger: {
					trigger: el,
					scrub: 1,
					start: "top 50%",
					end: "top 30%",
					toggleActions: "play none none reverse",
					markers: false,
				},
			});

			tl11.set(el, { transformOrigin: "center center" }).fromTo(
				el,
				{ opacity: 1 },
				{ opacity: 0, duration: 1, immediateRender: true }
			);
		});
	}

	gsap.utils.toArray(".tna-discount-2-bg-animation").forEach((el, index) => {
		let tl12 = gsap.timeline({
			scrollTrigger: {
				trigger: el,
				scrub: 0.5,
				start: "top 90%",
				end: "top 50%",
				toggleActions: "play none none reverse",
				markers: false,
			},
		});

		tl12.set(el, { transformOrigin: "center center" }).fromTo(
			el,
			{
				clipPath:
					"polygon(100% 0, 100% 57%, 76% 57%, 76% 100%, 0 100%, 0 0)",
			},
			{
				clipPath: "polygon(100% 0, 100% 0, 0 0, 0 100%, 0 100%, 0 0)",
				duration: 1,
				immediateRender: true,
			}
		);
	});

	// section-title-animation-start

	window.onload = function () {
		var st = $(".txa-split-text");
		if (st.length == 0) return;
		gsap.registerPlugin(SplitText);
		st.each(function (index, el) {
			el.split = new SplitText(el, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});
			gsap.set(el, { perspective: 400 });

			if ($(el).hasClass("txa-split-in-up")) {
				gsap.set(el.split.lines, {
					opacity: 1,
					y: "80",
					ease: "circ.out",
				});
			}

			el.anim = gsap.to(el.split.lines, {
				scrollTrigger: {
					trigger: el,
					// toggleActions: "restart pause resume reverse",
					start: "top 90%",
				},
				x: "0",
				y: "0",
				rotateX: "0",
				color: "inherit",
				webkitTextStroke: "0px white",
				scale: 1,
				opacity: 1,
				duration: 0.8,
				stagger: 0.02,
			});
		});
	};
	// section-title-animation-end


	// imageAnimationActive
	function imageAnimationActive($scope, $) {
		const boxes = gsap.utils.toArray(
			".tx-animation-style1,.tel-img-animation"
		);
		boxes.forEach((img) => {
			gsap.to(img, {
				scrollTrigger: {
					trigger: img,
					start: "top 70%",
					end: "bottom bottom",
					toggleClass: "active",
					once: true,
				},
			});
		});
	}

	// --------------------animation-end----------------------------- //
	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/hero_section.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/hero_slider_six.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/movie_poster_two.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/service_slider_four.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_about.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_cta.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_newsletter.default",
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/service_slider_two.default",
			serviceTwoSlider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_counter.default",
			counterActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_progress.default",
			progressActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/movie_poster.default",
			moviePosterActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/testimonial_four.default",
			testimonialFourActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/testimonial_four.default",
			testimonialFourActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_brand.default",
			chanelSliderActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_streaming.default",
			movieListSliderActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/service_slider_four.default",
			raceWrapper
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/service_slider_three.default",
			raceWrapper
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/movie_poster_two.default",
			moviePosterTwo
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_about.default",
			tna_opacity
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/post_grid.default",
			blogSticky
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_cta.default",
			ctaActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_newsletter.default",
			newsletterActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/hero_slider_six.default",
			heroSliderThreeActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/service_slider_five.default",
			serviceThreeSliderActive,
			bgImage
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pricing_tab.default",
			priceThreeActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/testimonial_five.default",
			testimonialThreeActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/telnet_gallery.default",
			galleryThreeActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/movie_poster_tab.default",
			moviePosterTabActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/image_box.default",
			imageAnimationActive
		);
	});
})(jQuery);
