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
			scrollTop: function (){
				$(window).on("scroll", function() {
					if ($(this).scrollTop() > 200) {
						$('.tx-scrollup').fadeIn();
					} else {
						$('.tx-scrollup').fadeOut();
					}
				});

				$('.tx-scrollup').on("click", function()  {
					$("html, body").animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			},
			StickyHeader: function (){
				jQuery(window).on('scroll', function() {
					if (jQuery(window).scrollTop() > 250) {
						jQuery('.tx-header__styleDefault.header_style_four').addClass('sticky-on')
					} else {
						jQuery('.tx-header__styleDefault.header_style_four').removeClass('sticky-on')
					}
				});
				jQuery(document).ready(function (o) {
					0 < o(".navSidebar-button").length &&
					o(".navSidebar-button").on("click", function (e) {
						e.preventDefault(), e.stopPropagation(), o(".info-group").addClass("isActive");
					}),
					0 < o(".close-side-widget").length &&
					o(".close-side-widget").on("click", function (e) {
						e.preventDefault(), o(".info-group").removeClass("isActive");
					}),
					o(".xs-sidebar-widget").on("click", function (e) {
						e.stopPropagation();
					})
				});
				$('.search-btn').on('click', function() {
					$('.search-body').toggleClass('search-open');
				});
				$(document).ready(function () {
					$('.cart_close_btn, .body-overlay').on('click', function () {
						$('.cart_sidebar').removeClass('active');
						$('.body-overlay').removeClass('active');
					});

					$('.header-cart-btn').on('click', function () {
						$('.cart_sidebar').addClass('active');
						$('.body-overlay').addClass('active');
					});
				});
			},
			TwinMax: function (){
				var $circleCursor = $(".cursor");

				function moveCursor(e) {
					var t = e.clientX + "px",
					a = e.clientY + "px";
					TweenMax.to($circleCursor, .2, {
						left: t,
						top: a,
						ease: "Power1.easeOut"
					})
				}

				function zoomCursor(e) {
					TweenMax.to($circleCursor, .1, {
						scale: 3,
						ease: "Power1.easeOut"
					}), $($circleCursor).removeClass("cursor-close")
				}

				function closeCursor(e) {
					TweenMax.to($circleCursor, .1, {
						scale: 3,
						ease: "Power1.easeOut"
					}), $($circleCursor).addClass("cursor-close")
				}

				function defaultCursor(e) {
					TweenLite.to($circleCursor, .1, {
						scale: 1,
						ease: "Power1.easeOut"
					}), $($circleCursor).removeClass("cursor-close")
				}
				$(window).on("mousemove", moveCursor),
				$("a, button, .zoom-cursor").on("mouseenter", zoomCursor),
				$(".trigger-close").on("mouseenter", closeCursor),
				$("a, button, .zoom-cursor, .trigger-close, .trigger-plus").on("mouseleave", defaultCursor);
			},
			TelNetAnimation: function (){
				gsap.registerPlugin(ScrollTrigger, ScrollSmoother, TweenMax, ScrollToPlugin);
				gsap.config({
					nullTargetWarn: false,
				});
				let splitTitleLines = gsap.utils.toArray(".headline-title");
				splitTitleLines.forEach(splitTextLine => {
					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: splitTextLine,
							start: 'top 90%',
							end: 'bottom 60%',
							scrub: false,
							markers: false,
							toggleActions: 'play none none none'
						}
					});
					const itemSplitted = new SplitText(splitTextLine, { type: "words, lines" });
					gsap.set(splitTextLine, { perspective: 400 });
					itemSplitted.split({ type: "lines" })
					tl.from(itemSplitted.lines, { duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
				});

			},
			TitleAnimation: function (){
				$(document).ready(function() {
					var st = $(".tx-split-textt");
					if(st.length == 0) return;
					gsap.registerPlugin(SplitText);
					st.each(function(index, el) {
						el.split = new SplitText(el, {
							type: "lines,words,chars",
							linesClass: "split-line"
						});
						gsap.set(el, { perspective: 400 });

						if( $(el).hasClass('split-in-fade') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								ease: "Back.easeOut",
							});
						}
						if( $(el).hasClass('split-in-right') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								x: "50",
								ease: "Back.easeOut",
							});
						}
						if( $(el).hasClass('split-in-left') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								x: "-50",
								ease: "circ.out",
							});
						}
						if( $(el).hasClass('split-in-up') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								y: "80",
								ease: "circ.out",
							});
						}
						if( $(el).hasClass('split-in-down') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								y: "-80",
								ease: "circ.out",
							});
						}
						if( $(el).hasClass('split-in-rotate') ){
							gsap.set(el.split.chars, {
								opacity: 0,
								rotateX: "50deg",
								ease: "circ.out",
							});
						}
						if( $(el).hasClass('split-in-scale') ){
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

				splitTextLines.forEach(splitTextLine => {
					const tl = gsap.timeline({
						scrollTrigger: {
							trigger: splitTextLine,
							start: 'top 90%',
							duration: 2,
							end: 'bottom 60%',
							scrub: false,
							markers: false,
							toggleActions: 'play none none none'
						}
					});

					const itemSplitted = new SplitText(splitTextLine, { type: "lines" });
					gsap.set(splitTextLine, { perspective: 400 });
					itemSplitted.split({ type: "lines" })
					tl.from(itemSplitted.lines, { duration: 1, delay: 0.5, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
				});
				$(window).on('load', function(){
					const boxes = gsap.utils.toArray('.tx-animation-style1,.tel-img-animation');
					boxes.forEach(img => {
						gsap.to(img, {
							scrollTrigger: {
								trigger: img,
								start: "top 70%",
								end: "bottom bottom",
								toggleClass: "active",
								once: true,
							}
						});
					});
				});
			},
		},
	};

	jQuery(document).ready(function () {
		TelnetCore.init();
	});

	$(window).on('load', function(){
		 $('#tx-preloader').fadeOut('slow',function(){$(this).remove();});
	})

	// Active wow js
	new WOW().init();
})(jQuery);
