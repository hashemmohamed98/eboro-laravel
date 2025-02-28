$(document).ready(function() {
	$(".menu-btn").on("click", function() {
		// $(".left-sidebar").toggleClass('expanded');
		// $(".left-sidebar .logo img").toggleClass("expanded");
		// $(".left-sidebar .sidebar-link").toggleClass("sm-padding");
		// $(".left-sidebar .sidebar-links").toggleClass("sm-padding");
		// $(".left-sidebar .sidebar-link .link-text").toggleClass("d-none");
		// $(".left-sidebar .bycodiano .by-text").toggleClass("d-none");
		$(".main-content").toggleClass("sm-content");
		$(".main-wrapper").toggleClass("justify-content-between");
		$(".right-sidebar").toggleClass("right-bar");
	})

	$(".left-sidebar").on("mouseover", function() {
		$(".left-sidebar").removeClass('expanded');
		$(".left-sidebar .logo img").removeClass("expanded");
		$(".left-sidebar .sidebar-link").removeClass("sm-padding");
		$(".left-sidebar .sidebar-links").removeClass("sm-padding");
		$(".left-sidebar .sidebar-link .link-text").removeClass("d-none");
		$(".left-sidebar .bycodiano .by-text").removeClass("d-none");
		$(".main-content").addClass("sm-content-hover");
	})
	$(".left-sidebar").on("mouseout", function() {
		$(".left-sidebar").addClass('expanded');
		$(".left-sidebar .logo img").addClass("expanded");
		$(".left-sidebar .sidebar-link").addClass("sm-padding");
		$(".left-sidebar .sidebar-links").addClass("sm-padding");
		$(".left-sidebar .sidebar-link .link-text").addClass("d-none");
		$(".left-sidebar .bycodiano .by-text").addClass("d-none");
		$(".main-content").removeClass("sm-content-hover");
	})

	$(".dropdown-header").on("click", function() {
		$(".dropdown-content").slideToggle("fast");
	});

	$(".dropdown-content li a").on("click", function(e) {
		e.preventDefault();
		$(".menu-value").text($(this).text());
		$(".dropdown-content").slideUp("fast");
	});

	$(".input-search").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".eboro-box").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	})



	$(".menu-btn-mob").on("click", function() {
		$(".left-sidebar").toggleClass("left-mob");
	})











})


// Icon Navigation
var forEach = function (t, o, r) { if ("[object Object]" === Object.prototype.toString.call(t)) for (var c in t) Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t); else for (var e = 0, l = t.length; l > e; e++)o.call(r, t[e], e, t) };

var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
	forEach(hamburgers, function (hamburger) {
		hamburger.addEventListener("click", function () {
			this.classList.toggle("is-active");
		}, false);
	});
}

