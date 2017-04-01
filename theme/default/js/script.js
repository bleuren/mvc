console.log("%c\u9019\u4e0d\u662f\u4f60\u8a72\u4f86\u7684\u5730\u65b9\n\u6709\u554f\u984c\u8acb\u6d3dpaste.ren@gmail.com(\u4efb\u5bb6\u8f1d)","color: #f00; font-size: 50px;");
for (var pjax = document.getElementsByClassName("pjax"), i = 0; i < pjax.length; i++) pjax[i].addEventListener("click", function(a) {
	href = a.target.search;
	console.log(a.target.search);
	loadContent(href);
	history.pushState("", "New URL: " + href, href);
	a.preventDefault()
});
window.onpopstate = function(a) {
	loadContent(document.location.href)
};

function loadContent(a) {
	var b = new XMLHttpRequest;
	b.onreadystatechange = function() {
		if (4 == this.readyState && 200 == this.status) {
			var a = JSON.parse(this.responseText),
				b;
			for (b in a) {
				var f = b.split("#");
				document.getElementById(f[f.length - 1]).innerHTML = a[b]
			}
		}
	};
	b.open("GET", "index.php?mod=pages&act=json&query=" + encodeURIComponent(a), !0);
	b.send()
}
$(window).load(function() {
	$("#loader").fadeOut()
});
$(document).ready(function(a) {
	function b(b) {
		k = b;
		f = a("<div>", {
			id: "progressBar"
		});
		l = a("<div>", {
			id: "bar"
		});
		f.append(l).prependTo(k);
		start()
	}
	function d() {}
	var c = function() {
			var b = a("header").height();
			a(".hidden-header").css({
				height: b + "px"
			})
		};
	a(window).load(function() {
		c()
	});
	a(window).resize(function() {
		c()
	});
	a(".skill-shortcode").appear(function() {
		a(".progress").each(function() {
			a(".progress-bar").css("width", function() {
				return a(this).attr("data-percentage") + "%"
			})
		})
	}, {
		accY: -100
	});
	a(".timer").countTo();
	a(".counter-item").appear(function() {
		a(".timer").countTo()
	}, {
		accY: -100
	});
	a("html").niceScroll({
		scrollspeed: 100,
		mousescrollstep: 38,
		cursorwidth: 5,
		cursorborder: 0,
		cursorcolor: "#333",
		autohidemode: !0,
		zindex: 999999999,
		horizrailenabled: !1,
		cursorborderradius: 0
	});
	a(".nav > li:has(ul)").addClass("drop");
	a(".nav > li.drop > ul").addClass("dropdown");
	a(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");
	a(".show-search").click(function() {
		a(".search-form").fadeIn(300);
		a(".search-form input").focus()
	});
	a(".search-form input").blur(function() {
		a(".search-form").fadeOut(300)
	});
	a(window).scroll(function() {
		200 < a(this).scrollTop() ? a(".back-to-top").fadeIn(400) : a(".back-to-top").fadeOut(400)
	});
	a(".back-to-top").click(function(b) {
		b.preventDefault();
		a("html, body").animate({
			scrollTop: 0
		}, 600);
		return !1
	});
	var f, l, k;
	a(".touch-slider").each(function() {
		var m = jQuery(this),
			e = a(this).attr("data-slider-navigation"),
			c = a(this).attr("data-slider-pagination"),
			h = a(this).attr("data-slider-progress-bar");
		if ("true" == h || "1" == h) var h = b,
			g = !1;
		else h = !1, g = !0;
		m.owlCarousel({
			navigation: "false" == e || "0" == e ? !1 : !0,
			pagination: "true" == c || "1" == c ? !0 : !1,
			slideSpeed: 400,
			paginationSpeed: 400,
			lazyLoad: !0,
			singleItem: !0,
			autoHeight: !0,
			autoPlay: g,
			stopOnHover: g,
			transitionStyle: "fade",
			afterInit: h,
			startDragging: d
		})
	});
	a(".projects-carousel").owlCarousel({
		navigation: !0,
		pagination: !1,
		slideSpeed: 400,
		stopOnHover: !0,
		autoPlay: 3E3,
		items: 4,
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [479, 1]
	});
	a(".testimonials-carousel").owlCarousel({
		navigation: !0,
		pagination: !1,
		slideSpeed: 2500,
		stopOnHover: !0,
		autoPlay: 3E3,
		singleItem: !0,
		autoHeight: !0,
		transitionStyle: "fade"
	});
	a(".custom-carousel").each(function() {
		var b = jQuery(this),
			e = a(this).attr("data-appeared-items"),
			d = a(this).attr("data-navigation");
		if (1 == e) var c = 1,
			g = 1,
			f = 1;
		else 2 <= e && 4 > e ? (c = e, g = e - 1, f = e - 1) : 4 <= e && 8 > e ? (c = e - 1, g = e - 2, f = e - 3) : (c = e - 3, g = e - 6, f = e - 8);
		b.owlCarousel({
			slideSpeed: 300,
			stopOnHover: !0,
			autoPlay: !1,
			navigation: "false" == d || "0" == d ? !1 : !0,
			pagination: !1,
			lazyLoad: !0,
			items: e,
			itemsDesktop: [1E3, c],
			itemsDesktopSmall: [900, g],
			itemsTablet: [600, f],
			itemsMobile: !1,
			transitionStyle: "goDown"
		})
	});
	a(".fullwidth-projects-carousel").owlCarousel({
		navigation: !1,
		pagination: !1,
		slideSpeed: 400,
		stopOnHover: !0,
		autoPlay: 3E3,
		items: 5,
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [479, 1]
	});
	a("#myTab a").click(function(b) {
		b.preventDefault();
		a(this).tab("show")
	});
	a("*").each(function() {
		if (a(this).attr("data-animation")) {
			var b = a(this).attr("data-animation"),
				e = "delay-" + a(this).attr("data-animation-delay");
			a(this).appear(function() {
				a(this).addClass("animated").addClass(b);
				a(this).addClass("animated").addClass(e)
			})
		}
	});
	(function() {
		a(".pieChart").each(function() {
			a(this).appear(function() {
				var b = a(this),
					e = b.data("bar-color") ? b.data("bar-color") : "#F54F36",
					c = b.data("bar-width") ? b.data("bar-width") : 150;
				b.hasClass("pie-chart-loaded") || b.easyPieChart({
					animate: 2E3,
					size: c,
					lineWidth: 2,
					scaleColor: !1,
					trackColor: "#eee",
					barColor: e
				}).addClass("pie-chart-loaded")
			})
		})
	})();
	a("[data-progress-animation]").each(function() {
		var b = a(this);
		b.appear(function() {
			var a = b.attr("data-appear-animation-delay") ? b.attr("data-appear-animation-delay") : 1;
			1 < a && b.css("animation-delay", a + "ms");
			setTimeout(function() {
				b.animate({
					width: b.attr("data-progress-animation")
				}, 800)
			}, a)
		}, {
			accX: 0,
			accY: -50
		})
	});
	jQuery(".milestone-block").each(function() {
		jQuery(this).appear(function() {
			var a = parseInt(jQuery(this).find(".milestone-number").text());
			jQuery(this).find(".milestone-number").countTo({
				from: 0,
				to: a,
				speed: 4E3,
				refreshInterval: 60
			})
		}, {
			accX: 0,
			accY: 0
		})
	});
	a(".lightbox").nivoLightbox({
		effect: "fadeScale",
		keyboardNav: !0,
		errorMessage: "The requested content cannot be loaded. Please try again later."
	});
	a(".touch-slider").find(".owl-prev").html('<i class="fa fa-angle-left"></i>');
	a(".touch-slider").find(".owl-next").html('<i class="fa fa-angle-right"></i>');
	a(".touch-carousel, .testimonials-carousel").find(".owl-prev").html('<i class="fa fa-angle-left"></i>');
	a(".touch-carousel, .testimonials-carousel").find(".owl-next").html('<i class="fa fa-angle-right"></i>');
	a(".read-more").append('<i class="fa fa-angle-right"></i>');
	a("body").fitVids();
	a(".itl-tooltip").tooltip();
	a(".bg-parallax").each(function() {
		a(this).parallax("30%", .2)
	});
	a(".tlt").textillate({
		loop: !0,
		"in": {
			effect: "fadeInUp",
			delayScale: 2,
			delay: 50,
			sync: !1,
			shuffle: !1,
			reverse: !0
		},
		out: {
			effect: "fadeOutUp",
			delayScale: 2,
			delay: 50,
			sync: !1,
			shuffle: !1,
			reverse: !0
		}
	});
	(function() {
		function b() {
			100 <= (window.pageYOffset || c.scrollTop) ? (a(".top-bar").slideUp(300), a("header").addClass("fixed-header"), a(".navbar-brand").css({
				"padding-top": "19px",
				"padding-bottom": "19px"
			}), /iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || 479 > a(window).width() ? a(".navbar-default .navbar-nav > li > a").css({
				"padding-top": "0px",
				"padding-bottom": "0px"
			}) : (a(".navbar-default .navbar-nav > li > a").css({
				"padding-top": "20px",
				"padding-bottom": "20px"
			}), a(".search-side").css({
				"margin-top": "-7px"
			}))) : (a(".top-bar").slideDown(300), a("header").removeClass("fixed-header"), a(".navbar-brand").css({
				"padding-top": "27px",
				"padding-bottom": "27px"
			}), /iPhone|iPod|BlackBerry/i.test(navigator.userAgent) || 479 > a(window).width() ? a(".navbar-default .navbar-nav > li > a").css({
				"padding-top": "0px",
				"padding-bottom": "0px"
			}) : (a(".navbar-default .navbar-nav > li > a").css({
				"padding-top": "28px",
				"padding-bottom": "28px"
			}), a(".search-side").css({
				"margin-top": "0px"
			})));
			d = !1
		}
		var c = document.documentElement,
			d = !1;
		document.querySelector("header");
		(function() {
			window.addEventListener("scroll", function() {
				d || (d = !0, setTimeout(b, 250))
			}, !1)
		})()
	})()
});
jQuery(window).load(function() {
	var a = $("#portfolio");
	a.isotope({
		layoutMode: "masonry",
		filter: "*",
		animationOptions: {
			duration: 750,
			easing: "linear",
			queue: !1
		}
	});
	$(".portfolio-filter ul a").click(function() {
		var b = $(this).attr("data-filter");
		a.isotope({
			filter: b,
			animationOptions: {
				duration: 750,
				easing: "linear",
				queue: !1
			}
		});
		return !1
	});
	$(".portfolio-filter ul").find("a").click(function() {
		var a = $(this);
		if (a.hasClass("selected")) return !1;
		a.parents(".portfolio-filter ul").find(".selected").removeClass("selected");
		a.addClass("selected")
	})
});

function setActiveStyleSheet(a) {
	var b, d;
	for (b = 0; d = document.getElementsByTagName("link")[b]; b++) - 1 != d.getAttribute("rel").indexOf("style") && d.getAttribute("title") && (d.disabled = !0, d.getAttribute("title") == a && (d.disabled = !1))
}
function getActiveStyleSheet() {
	var a, b;
	for (a = 0; b = document.getElementsByTagName("link")[a]; a++) if (-1 != b.getAttribute("rel").indexOf("style") && b.getAttribute("title") && !b.disabled) return b.getAttribute("title");
	return null
}
function getPreferredStyleSheet() {
	var a, b;
	for (a = 0; b = document.getElementsByTagName("link")[a]; a++) if (-1 != b.getAttribute("rel").indexOf("style") && -1 == b.getAttribute("rel").indexOf("alt") && b.getAttribute("title")) return b.getAttribute("title");
	return null
}
function createCookie(a, b, d) {
	if (d) {
		var c = new Date;
		c.setTime(c.getTime() + 864E5 * d);
		d = "; expires=" + c.toGMTString()
	} else d = "";
	document.cookie = a + "=" + b + d + "; path=/"
}
function readCookie(a) {
	a += "=";
	for (var b = document.cookie.split(";"), d = 0; d < b.length; d++) {
		for (var c = b[d];
		" " == c.charAt(0);) c = c.substring(1, c.length);
		if (0 == c.indexOf(a)) return c.substring(a.length, c.length)
	}
	return null
}
function addLoadEvent(function2) {
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = function2;
	} else {
		window.onload = function() {
			if (oldonload) {
				oldonload();
			}
			function2();
		}
	}
}
addLoadEvent(function(a) {
	a = (a = readCookie("style")) ? a : getPreferredStyleSheet();
	setActiveStyleSheet(a)
});
// window.onload = function(a) {
	// a = (a = readCookie("style")) ? a : getPreferredStyleSheet();
	// setActiveStyleSheet(a)
// };
window.onunload = function(a) {
	a = getActiveStyleSheet();
	createCookie("style", a, 365)
};
var cookie = readCookie("style"),
	title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
$(document).ready(function() {
	$(document).ready(function() {
		$(".open-switcher").click(function() {
			$(this).hasClass("show-switcher") ? ($(".switcher-box").css({
				left: 0
			}), $(".open-switcher").removeClass("show-switcher"), $(".open-switcher").addClass("hide-switcher")) : jQuery(this).hasClass("hide-switcher") && ($(".switcher-box").css({
				left: "-212px"
			}), $(".open-switcher").removeClass("hide-switcher"), $(".open-switcher").addClass("show-switcher"))
		})
	});
	$(".topbar-style").change(function() {
		1 == $(this).val() ? ($(".top-bar").removeClass("dark-bar"), $(".top-bar").removeClass("color-bar"), $(window).resize()) : 2 == $(this).val() ? ($(".top-bar").removeClass("color-bar"), $(".top-bar").addClass("dark-bar"), $(window).resize()) : 3 == $(this).val() && ($(".top-bar").removeClass("dark-bar"), $(".top-bar").addClass("color-bar"), $(window).resize())
	});
	$(".layout-style").change(function() {
		1 == $(this).val() ? $("#container").removeClass("boxed-page") : $("#container").addClass("boxed-page");
		$(window).resize()
	});
	$(".switcher-box .bg-list li a").click(function() {
		if ("2" == $(".switcher-box select[id=layout-style]").find("option:selected").val()) {
			var a = $(this).css("backgroundImage");
			$("body").css("backgroundImage", a)
		} else alert("Please select boxed layout")
	})
});
$(".wpb-mobile-menu").slicknav({
	prependTo: ".navbar-header",
	parentTag: "margo",
	allowParentLinks: !0,
	duplicate: !1,
	label: "",
	closedSymbol: '<i class="fa fa-angle-right"></i>',
	openedSymbol: '<i class="fa fa-angle-down"></i>'
});