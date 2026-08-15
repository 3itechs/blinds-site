/**
 * Theme behaviour: mobile nav toggle.
 *
 * The Figma file has only a 1440px desktop frame, so the toggle exists purely
 * to keep the navigation reachable below the 1080px breakpoint.
 */
(function () {
	"use strict";

	var toggle = document.querySelector(".bc-nav-toggle");
	var nav = document.getElementById("bc-primary-nav");

	if (!toggle || !nav) {
		return;
	}

	toggle.addEventListener("click", function () {
		var open = nav.classList.toggle("is-open");
		toggle.setAttribute("aria-expanded", open ? "true" : "false");
	});

	// Close the panel when focus or a click lands outside it.
	document.addEventListener("click", function (event) {
		if (!nav.classList.contains("is-open")) {
			return;
		}
		if (nav.contains(event.target) || toggle.contains(event.target)) {
			return;
		}
		nav.classList.remove("is-open");
		toggle.setAttribute("aria-expanded", "false");
	});

	document.addEventListener("keydown", function (event) {
		if (event.key === "Escape" && nav.classList.contains("is-open")) {
			nav.classList.remove("is-open");
			toggle.setAttribute("aria-expanded", "false");
			toggle.focus();
		}
	});
})();

/**
 * Hero slider. The design shows three slides with dot controls; auto-advance
 * pauses on hover and respects prefers-reduced-motion.
 */
(function () {
	"use strict";

	var hero = document.querySelector(".bc-hero");
	if (!hero) {
		return;
	}

	var slides = hero.querySelectorAll(".bc-hero__slide");
	var dots = hero.querySelectorAll(".bc-hero__dot");
	if (slides.length < 2) {
		return;
	}

	var index = 0;
	var timer = null;
	var DELAY = 6000;

	function show(next) {
		index = (next + slides.length) % slides.length;
		slides.forEach(function (slide, i) {
			slide.classList.toggle("is-active", i === index);
		});
		dots.forEach(function (dot, i) {
			dot.classList.toggle("is-active", i === index);
			dot.setAttribute("aria-selected", i === index ? "true" : "false");
		});
	}

	function start() {
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}
		stop();
		timer = window.setInterval(function () {
			show(index + 1);
		}, DELAY);
	}

	function stop() {
		if (timer) {
			window.clearInterval(timer);
			timer = null;
		}
	}

	dots.forEach(function (dot) {
		dot.addEventListener("click", function () {
			show(parseInt(dot.dataset.slide, 10) || 0);
			start();
		});
	});

	hero.addEventListener("mouseenter", stop);
	hero.addEventListener("mouseleave", start);
	document.addEventListener("visibilitychange", function () {
		if (document.hidden) {
			stop();
		} else {
			start();
		}
	});

	start();
})();

/**
 * FAQ accordion. Each question toggles its own panel; the design shows the
 * first one open on load, which the markup already reflects.
 */
(function () {
	"use strict";

	var questions = document.querySelectorAll(".bc-faq__q");
	if (!questions.length) {
		return;
	}

	questions.forEach(function (button) {
		button.addEventListener("click", function () {
			var panel = document.getElementById(button.getAttribute("aria-controls"));
			if (!panel) {
				return;
			}
			var open = button.getAttribute("aria-expanded") === "true";
			button.setAttribute("aria-expanded", open ? "false" : "true");
			panel.hidden = open;
		});
	});
})();

/**
 * Key Highlights disclosure list on the Motorised page.
 */
(function () {
	"use strict";

	var rows = document.querySelectorAll(".bc-motor__q");
	if (!rows.length) {
		return;
	}

	rows.forEach(function (button) {
		button.addEventListener("click", function () {
			var panel = document.getElementById(button.getAttribute("aria-controls"));
			if (!panel) {
				return;
			}
			var open = button.getAttribute("aria-expanded") === "true";
			button.setAttribute("aria-expanded", open ? "false" : "true");
			panel.hidden = open;
		});
	});
})();

/**
 * Gallery category filter. Filtering is client-side because the grid is a
 * fixed set of twelve tiles rather than a paginated query.
 */
(function () {
	"use strict";

	var buttons = document.querySelectorAll(".bc-gallery__filter");
	var items = document.querySelectorAll(".bc-gallery__item");
	if (!buttons.length || !items.length) {
		return;
	}

	buttons.forEach(function (button) {
		button.addEventListener("click", function () {
			var filter = button.dataset.filter;

			buttons.forEach(function (other) {
				var active = other === button;
				other.classList.toggle("is-active", active);
				other.setAttribute("aria-pressed", active ? "true" : "false");
			});

			items.forEach(function (item) {
				item.hidden = filter !== "all" && item.dataset.category !== filter;
			});
		});
	});
})();

/**
 * Product gallery: clicking a thumbnail swaps the main image.
 */
(function () {
	"use strict";

	var main = document.getElementById("bc-product-main");
	var thumbs = document.querySelectorAll(".bc-product__thumb");
	if (!main || !thumbs.length) {
		return;
	}

	thumbs.forEach(function (thumb) {
		thumb.addEventListener("click", function () {
			var full = thumb.dataset.full;
			if (!full) {
				return;
			}
			main.src = full;
			thumbs.forEach(function (other) {
				other.classList.toggle("is-active", other === thumb);
			});
		});
	});
})();
