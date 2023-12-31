$.extend(!0, $.fn.dataTable.defaults, {sDom: "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>", oLanguage: {sLengthMenu: "Display _MENU_ records"}}), $.extend($.fn.dataTableExt.oStdClasses, {sWrapper: "dataTables_wrapper form-inline", sFilterInput: "form-control input-sm", sLengthSelect: "form-control input-sm"}), $.fn.dataTable.Api ? ($.fn.dataTable.defaults.renderer = "bootstrap", $.fn.dataTable.ext.renderer.pageButton.bootstrap = function (a, b, c, d, e, f) {
    var g, h, i = new $.fn.dataTable.Api(a), j = a.oClasses, k = a.oLanguage.oPaginate, l = function (b, d) {
        var m, n, o, p, q = function (a) {
            a.preventDefault(), "ellipsis" !== a.data.action && i.page(a.data.action).draw(!1)
        };
        for (m = 0, n = d.length; n > m; m++)if (p = d[m], $.isArray(p))l(b, p); else {
            switch (g = "", h = "", p) {
                case"ellipsis":
                    g = "&hellip;", h = "disabled";
                    break;
                case"first":
                    g = k.sFirst, h = p + (e > 0 ? "" : " disabled");
                    break;
                case"previous":
                    g = k.sPrevious, h = p + (e > 0 ? "" : " disabled");
                    break;
                case"next":
                    g = k.sNext, h = p + (f - 1 > e ? "" : " disabled");
                    break;
                case"last":
                    g = k.sLast, h = p + (f - 1 > e ? "" : " disabled");
                    break;
                default:
                    g = p + 1, h = e === p ? "active" : ""
            }
            g && (o = $("<li>", {"class": j.sPageButton + " " + h, "aria-controls": a.sTableId, tabindex: a.iTabIndex, id: 0 === c && "string" == typeof p ? a.sTableId + "_" + p : null}).append($("<a>", {href: "#"}).html(g)).appendTo(b), a.oApi._fnBindAction(o, {action: p}, q))
        }
    };
    l($(b).empty().html('<ul class="pagination"/>').children("ul"), d)
}) : ($.fn.dataTable.defaults.sPaginationType = "bootstrap", $.fn.dataTableExt.oApi.fnPagingInfo = function (a) {
    return{iStart: a._iDisplayStart, iEnd: a.fnDisplayEnd(), iLength: a._iDisplayLength, iTotal: a.fnRecordsTotal(), iFilteredTotal: a.fnRecordsDisplay(), iPage: -1 === a._iDisplayLength ? 0 : Math.ceil(a._iDisplayStart / a._iDisplayLength), iTotalPages: -1 === a._iDisplayLength ? 0 : Math.ceil(a.fnRecordsDisplay() / a._iDisplayLength)}
}, $.extend($.fn.dataTableExt.oPagination, {bootstrap: {fnInit: function (a, b, c) {
    var d = (a.oLanguage.oPaginate, function (b) {
        b.preventDefault(), a.oApi._fnPageChange(a, b.data.action) && c(a)
    });
    $(b).append('<ul class="pagination"><li class="prev disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li><li class="prev disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li><li class="next disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li><li class="next disabled"><a href="#"><i class="fa fa-angle-double-right"></i></a></li></ul>');
    var e = $("a", b);
    $(e[0]).bind("click.DT", {action: "first"}, d), $(e[1]).bind("click.DT", {action: "previous"}, d), $(e[2]).bind("click.DT", {action: "next"}, d), $(e[3]).bind("click.DT", {action: "last"}, d)
}, fnUpdate: function (a, b) {
    var c, d, e, f, g, h, i = 5, j = a.oInstance.fnPagingInfo(), k = a.aanFeatures.p, l = Math.floor(i / 2);
    for (j.iTotalPages < i ? (g = 1, h = j.iTotalPages) : j.iPage <= l ? (g = 1, h = i) : j.iPage >= j.iTotalPages - l ? (g = j.iTotalPages - i + 1, h = j.iTotalPages) : (g = j.iPage - l + 1, h = g + i - 1), c = 0, d = k.length; d > c; c++) {
        for ($("li:gt(0)", k[c]).filter(":not(.next,.prev)").remove(), e = g; h >= e; e++)f = e == j.iPage + 1 ? 'class="active"' : "", $("<li " + f + '><a href="#">' + e + "</a></li>").insertBefore($("li.next:eq(0)", k[c])[0]).bind("click", function (c) {
            c.preventDefault(), a._iDisplayStart = (parseInt($("a", this).text(), 10) - 1) * j.iLength, b(a)
        });
        0 === j.iPage ? $("li.prev", k[c]).addClass("disabled") : $("li.prev", k[c]).removeClass("disabled"), j.iPage === j.iTotalPages - 1 || 0 === j.iTotalPages ? $("li.next", k[c]).addClass("disabled") : $("li.next", k[c]).removeClass("disabled")
    }
}}})), $.fn.DataTable.TableTools && ($.extend(!0, $.fn.DataTable.TableTools.classes, {container: "DTTT btn-group", buttons: {normal: "btn btn-default", disabled: "disabled"}, collection: {container: "DTTT_dropdown dropdown-menu", buttons: {normal: "", disabled: "disabled"}}, print: {info: "DTTT_print_info modal"}, select: {row: "active"}}), $.extend(!0, $.fn.DataTable.TableTools.DEFAULTS.oTags, {collection: {container: "ul", button: "li", liner: "a"}}));