! function(e) {
    e.fn.pagination = function(a) {
        function t(t) {
            var s = e("." + r.contents + ".current").children().length,
                l = Math.ceil(s / r.items),
                o = '<ul id="page-navi">\t<li><a href="#" class="previos">' + r.previous + "</a></li>";
            for (i = 0; i < l; i++) o += '\t<li><a href="#">' + (i + 1) + "</a></li>";
            o += '\t<li><a href="#" class="next">' + r.next + "</a></li></ul>";
            var c = t;
            0 == t ? (c = parseInt(e("#page-navi li a.current").html())) - 1 != 0 && c-- : t == l + 1 && (c = parseInt(e("#page-navi li a.current").html())) + 1 != l + 1 && c++, t = c, 0 == s && (o = ""), e("#page-navi").remove(), "top" == r.position ? e("." + r.contents + ".current").before(o) : e("." + r.contents + ".current").after(o), e("#page-navi li a").removeClass("current"), e("#page-navi li a").eq(t).addClass("current"), e("#page-navi li a").removeClass("disable"), c = parseInt(e("#page-navi li a.current").html()), c - 1 == 0 && e("#page-navi li a.previos").addClass("disable"), c == l && e("#page-navi li a.next").addClass("disable");
            var u = a.items * (t - 1),
                d = a.items * t;
            t == l && (d = s), e("." + r.contents + ".current").children().hide(), e("." + r.contents + ".current").children().slice(u, d).fadeIn(a.time), 1 == r.scroll && e("html,body").animate({
                scrollTop: n
            }, 0)
        }
        var r = {
                items: 5,
                contents: "contents",
                previous: "Previous&raquo;",
                next: "&laquo;Next",
                time: 800,
                start: 1,
                position: "bottom",
                scroll: !0
            },
            r = e.extend(r, a);
        e(this).addClass("jquery-tab-pager-tabbar"), $tab = e(this).find("li");
        var n = 0;
        ! function() {
            var a = r.start - 1;
            $tab.eq(a).addClass("current"), e("." + r.contents).hide().eq(a).show().addClass("current"), t(1)
        }(), $tab.click(function() {
            var a = $tab.index(this);
            $tab.removeClass("current"), e(this).addClass("current"), e("." + r.contents).removeClass("current").hide().eq(a).addClass("current").fadeIn(r.time), t(1)
        }), e(document).on("click", "#page-navi li a", function() {
            return !e(this).hasClass("disable") && (t(e("#page-navi li a").index(this)), !1)
        }), e(window).on("load scroll", function() {
            n = e(window).scrollTop()
        })
    }
}(jQuery);
