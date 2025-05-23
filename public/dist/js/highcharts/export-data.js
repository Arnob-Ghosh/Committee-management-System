/*
 Highcharts JS v10.2.0 (2022-07-05)

 Exporting module

 (c) 2010-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (a) {
    "object" === typeof module && module.exports ? (a["default"] = a, module.exports = a) : "function" === typeof define && define.amd ? define("highcharts/modules/export-data", ["highcharts", "highcharts/modules/exporting"], function (m) {
        a(m);
        a.Highcharts = m;
        return a
    }) : a("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function (a) {
    function m(a, d, c, p) {
        a.hasOwnProperty(d) || (a[d] = p.apply(null, c), "function" === typeof CustomEvent && window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded", {
            detail: {
                path: d,
                module: a[d]
            }
        })))
    }
    a = a ? a._modules : {};
    m(a, "Extensions/DownloadURL.js", [a["Core/Globals.js"]], function (a) {
        var d = a.isSafari,
            c = a.win,
            p = c.document,
            f = c.URL || c.webkitURL || c,
            r = a.dataURLtoBlob = function (a) {
                if ((a = a.replace(/filename=.*;/, "").match(/data:([^;]*)(;base64)?,([0-9A-Za-z+/]+)/)) && 3 < a.length && c.atob && c.ArrayBuffer && c.Uint8Array && c.Blob && f.createObjectURL) {
                    var d = c.atob(a[3]),
                        y = new c.ArrayBuffer(d.length);
                    y = new c.Uint8Array(y);
                    for (var l = 0; l < y.length; ++l) y[l] = d.charCodeAt(l);
                    a = new c.Blob([y], {
                        type: a[1]
                    });
                    return f.createObjectURL(a)
                }
            };
        a = a.downloadURL = function (a, f) {
            var w = c.navigator,
                l = p.createElement("a");
            if ("string" === typeof a || a instanceof String || !w.msSaveOrOpenBlob) {
                a = "".concat(a);
                w = /Edge\/\d+/.test(w.userAgent);
                if (d && "string" === typeof a && 0 === a.indexOf("data:application/pdf") || w || 2E6 < a.length)
                    if (a = r(a) || "", !a) throw Error("Failed to convert to blob");
                if ("undefined" !== typeof l.download) l.href = a, l.download = f, p.body.appendChild(l), l.click(), p.body.removeChild(l);
                else try {
                    var n = c.open(a, "chart");
                    if ("undefined" === typeof n || null ===
                        n) throw Error("Failed to open window");
                } catch (t) {
                    c.location.href = a
                }
            } else w.msSaveOrOpenBlob(a, f)
        };
        return {
            dataURLtoBlob: r,
            downloadURL: a
        }
    });
    m(a, "Extensions/ExportData.js", [a["Core/Axis/Axis.js"], a["Core/Chart/Chart.js"], a["Core/Renderer/HTML/AST.js"], a["Core/Globals.js"], a["Core/DefaultOptions.js"], a["Core/Utilities.js"], a["Extensions/DownloadURL.js"]], function (a, d, c, p, f, r, y) {
        function m(a, e) {
            var b = t.navigator,
                B = -1 < b.userAgent.indexOf("WebKit") && 0 > b.userAgent.indexOf("Chrome"),
                z = t.URL || t.webkitURL ||
                t;
            try {
                if (b.msSaveOrOpenBlob && t.MSBlobBuilder) {
                    var g = new t.MSBlobBuilder;
                    g.append(a);
                    return g.getBlob("image/svg+xml")
                }
                if (!B) return z.createObjectURL(new t.Blob(["\ufeff" + a], {
                    type: e
                }))
            } catch (Q) {}
        }
        var w = this && this.__spreadArray || function (a, e, k) {
                if (k || 2 === arguments.length)
                    for (var b = 0, z = e.length, g; b < z; b++) !g && b in e || (g || (g = Array.prototype.slice.call(e, 0, b)), g[b] = e[b]);
                return a.concat(g || Array.prototype.slice.call(e))
            },
            l = p.doc,
            n = p.seriesTypes,
            t = p.win;
        p = f.getOptions;
        f = f.setOptions;
        var I = r.addEvent,
            M = r.defined,
            J = r.extend,
            N = r.find,
            G = r.fireEvent,
            O = r.isNumber,
            x = r.pick,
            K = y.downloadURL;
        f({
            exporting: {
                csv: {
                    annotations: {
                        itemDelimiter: "; ",
                        join: !1
                    },
                    columnHeaderFormatter: null,
                    dateFormat: "%Y-%m-%d %H:%M:%S",
                    decimalPoint: null,
                    itemDelimiter: null,
                    lineDelimiter: "\n"
                },
                showTable: !1,
                useMultiLevelHeaders: !0,
                useRowspanHeaders: !0
            },
            lang: {
                downloadCSV: "Download CSV",
                downloadXLS: "Download XLS",
                exportData: {
                    annotationHeader: "Annotations",
                    categoryHeader: "Category",
                    categoryDatetimeHeader: "DateTime"
                },
                viewData: "View data table",
                hideData: "Hide data table"
            }
        });
        I(d, "render", function () {
            this.options && this.options.exporting && this.options.exporting.showTable && !this.options.chart.forExport && this.viewData()
        });
        I(d, "afterViewData", function () {
            var a = this,
                e = a.dataTableDiv,
                k = document.querySelectorAll("thead")[0].querySelectorAll("tr")[0],
                B = function (a, b) {
                    return function (e, g) {
                        var k = (b ? e : g).children[a].textContent;
                        e = (b ? g : e).children[a].textContent;
                        return "" === k || "" === e || isNaN(k) || isNaN(e) ? k.toString().localeCompare(e) : k - e
                    }
                };
            e && k.childNodes.forEach(function (b) {
                var k = b.closest("table");
                b.addEventListener("click", function () {
                    var g = w([], e.querySelectorAll("tr:not(thead tr)"), !0),
                        d = w([], b.parentNode.children, !0);
                    g.sort(B(d.indexOf(b), a.ascendingOrderInTable = !a.ascendingOrderInTable)).forEach(function (a) {
                        k.appendChild(a)
                    });
                    d.forEach(function (a) {
                        ["highcharts-sort-ascending", "highcharts-sort-descending"].forEach(function (b) {
                            a.classList.contains(b) && a.classList.remove(b)
                        })
                    });
                    b.classList.add(a.ascendingOrderInTable ? "highcharts-sort-ascending" : "highcharts-sort-descending")
                })
            })
        });
        d.prototype.setUpKeyToAxis =
            function () {
                n.arearange && (n.arearange.prototype.keyToAxis = {
                    low: "y",
                    high: "y"
                });
                n.gantt && (n.gantt.prototype.keyToAxis = {
                    start: "x",
                    end: "x"
                })
            };
        d.prototype.getDataRows = function (b) {
            var e = this.hasParallelCoordinates,
                k = this.time,
                d = this.options.exporting && this.options.exporting.csv || {},
                c = this.xAxis,
                g = {},
                l = [],
                n = [],
                p = [],
                D;
            var E = this.options.lang.exportData;
            var f = E.categoryHeader,
                P = E.categoryDatetimeHeader,
                u = function (q, e, k) {
                    if (d.columnHeaderFormatter) {
                        var g = d.columnHeaderFormatter(q, e, k);
                        if (!1 !== g) return g
                    }
                    return q ?
                        q instanceof a ? q.options.title && q.options.title.text || (q.dateTime ? P : f) : b ? {
                            columnTitle: 1 < k ? e : q.name,
                            topLevelColumnTitle: q.name
                        } : q.name + (1 < k ? " (" + e + ")" : "") : f
                },
                L = function (a, b, e) {
                    var q = {},
                        k = {};
                    b.forEach(function (b) {
                        var g = (a.keyToAxis && a.keyToAxis[b] || b) + "Axis";
                        g = O(e) ? a.chart[g][e] : a[g];
                        q[b] = g && g.categories || [];
                        k[b] = g && g.dateTime
                    });
                    return {
                        categoryMap: q,
                        dateTimeValueAxisMap: k
                    }
                },
                r = function (a, b) {
                    return a.data.filter(function (a) {
                            return "undefined" !== typeof a.y && a.name
                        }).length && b && !b.categories && !a.keyToAxis ?
                        a.pointArrayMap && a.pointArrayMap.filter(function (a) {
                            return "x" === a
                        }).length ? (a.pointArrayMap.unshift("x"), a.pointArrayMap) : ["x", "y"] : a.pointArrayMap || ["y"]
                },
                v = [];
            var A = 0;
            this.setUpKeyToAxis();
            this.series.forEach(function (a) {
                var h = a.xAxis,
                    q = a.options.keys || r(a, h),
                    B = q.length,
                    l = !a.requireSorting && {},
                    m = c.indexOf(h),
                    z = L(a, q),
                    f;
                if (!1 !== a.options.includeInDataExport && !a.options.isInternal && !1 !== a.visible) {
                    N(v, function (a) {
                        return a[0] === m
                    }) || v.push([m, A]);
                    for (f = 0; f < B;) D = u(a, q[f], q.length), p.push(D.columnTitle ||
                        D), b && n.push(D.topLevelColumnTitle || D), f++;
                    var F = {
                        chart: a.chart,
                        autoIncrement: a.autoIncrement,
                        options: a.options,
                        pointArrayMap: a.pointArrayMap
                    };
                    a.options.data.forEach(function (b, u) {
                        e && (z = L(a, q, u));
                        var v = {
                            series: F
                        };
                        a.pointClass.prototype.applyOptions.apply(v, [b]);
                        b = v.x;
                        var c = a.data[u] && a.data[u].name;
                        f = 0;
                        if (!h || "name" === a.exportKey || !e && h && h.hasNames && c) b = c;
                        l && (l[b] && (b += "|" + u), l[b] = !0);
                        g[b] || (g[b] = [], g[b].xValues = []);
                        g[b].x = v.x;
                        g[b].name = c;
                        for (g[b].xValues[m] = v.x; f < B;) u = q[f], c = v[u], g[b][A + f] = x(z.categoryMap[u][c],
                            z.dateTimeValueAxisMap[u] ? k.dateFormat(d.dateFormat, c) : null, c), f++
                    });
                    A += f
                }
            });
            for (h in g) Object.hasOwnProperty.call(g, h) && l.push(g[h]);
            var h = b ? [n, p] : [p];
            for (A = v.length; A--;) {
                var F = v[A][0];
                var H = v[A][1];
                var m = c[F];
                l.sort(function (a, b) {
                    return a.xValues[F] - b.xValues[F]
                });
                E = u(m);
                h[0].splice(H, 0, E);
                b && h[1] && h[1].splice(H, 0, E);
                l.forEach(function (a) {
                    var b = a.name;
                    m && !M(b) && (m.dateTime ? (a.x instanceof Date && (a.x = a.x.getTime()), b = k.dateFormat(d.dateFormat, a.x)) : b = m.categories ? x(m.names[a.x], m.categories[a.x],
                        a.x) : a.x);
                    a.splice(H, 0, b)
                })
            }
            h = h.concat(l);
            G(this, "exportData", {
                dataRows: h
            });
            return h
        };
        d.prototype.getCSV = function (a) {
            var b = "",
                k = this.getDataRows(),
                c = this.options.exporting.csv,
                d = x(c.decimalPoint, "," !== c.itemDelimiter && a ? (1.1).toLocaleString()[1] : "."),
                g = x(c.itemDelimiter, "," === d ? ";" : ","),
                f = c.lineDelimiter;
            k.forEach(function (a, e) {
                for (var c, l = a.length; l--;) c = a[l], "string" === typeof c && (c = '"' + c + '"'), "number" === typeof c && "." !== d && (c = c.toString().replace(".", d)), a[l] = c;
                a.length = k.length ? k[0].length : 0;
                b +=
                    a.join(g);
                e < k.length - 1 && (b += f)
            });
            return b
        };
        d.prototype.getTable = function (a) {
            var b = function (a) {
                if (!a.tagName || "#text" === a.tagName) return a.textContent || "";
                var c = a.attributes,
                    e = "<".concat(a.tagName);
                c && Object.keys(c).forEach(function (a) {
                    var b = c[a];
                    e += " ".concat(a, '="').concat(b, '"')
                });
                e += ">";
                e += a.textContent || "";
                (a.children || []).forEach(function (a) {
                    e += b(a)
                });
                return e += "</".concat(a.tagName, ">")
            };
            a = this.getTableAST(a);
            return b(a)
        };
        d.prototype.getTableAST = function (a) {
            var b = 0,
                c = [],
                d = this.options,
                f = a ? (1.1).toLocaleString()[1] :
                ".",
                g = x(d.exporting.useMultiLevelHeaders, !0);
            a = this.getDataRows(g);
            var l = g ? a.shift() : null,
                m = a.shift(),
                n = function (a, b, c, e) {
                    var d = x(e, "");
                    b = "highcharts-text" + (b ? " " + b : "");
                    "number" === typeof d ? (d = d.toString(), "," === f && (d = d.replace(".", f)), b = "highcharts-number") : e || (b = "highcharts-empty");
                    c = J({
                        "class": b
                    }, c);
                    return {
                        tagName: a,
                        attributes: c,
                        textContent: d
                    }
                };
            !1 !== d.exporting.tableCaption && c.push({
                tagName: "caption",
                attributes: {
                    "class": "highcharts-table-caption"
                },
                textContent: x(d.exporting.tableCaption, d.title.text ?
                    d.title.text : "Chart")
            });
            for (var p = 0, r = a.length; p < r; ++p) a[p].length > b && (b = a[p].length);
            c.push(function (a, b, c) {
                var e = [],
                    f = 0;
                c = c || b && b.length;
                var l = 0,
                    h;
                if (h = g && a && b) {
                    a: if (h = a.length, b.length === h) {
                        for (; h--;)
                            if (a[h] !== b[h]) {
                                h = !1;
                                break a
                            } h = !0
                    } else h = !1;h = !h
                }
                if (h) {
                    for (h = []; f < c; ++f) {
                        var k = a[f];
                        var m = a[f + 1];
                        k === m ? ++l : l ? (h.push(n("th", "highcharts-table-topheading", {
                            scope: "col",
                            colspan: l + 1
                        }, k)), l = 0) : (k === b[f] ? d.exporting.useRowspanHeaders ? (m = 2, delete b[f]) : (m = 1, b[f] = "") : m = 1, k = n("th", "highcharts-table-topheading", {
                            scope: "col"
                        }, k), 1 < m && k.attributes && (k.attributes.valign = "top", k.attributes.rowspan = m), h.push(k))
                    }
                    e.push({
                        tagName: "tr",
                        children: h
                    })
                }
                if (b) {
                    h = [];
                    f = 0;
                    for (c = b.length; f < c; ++f) "undefined" !== typeof b[f] && h.push(n("th", null, {
                        scope: "col"
                    }, b[f]));
                    e.push({
                        tagName: "tr",
                        children: h
                    })
                }
                return {
                    tagName: "thead",
                    children: e
                }
            }(l, m, Math.max(b, m.length)));
            var t = [];
            a.forEach(function (a) {
                for (var c = [], e = 0; e < b; e++) c.push(n(e ? "td" : "th", null, e ? {} : {
                    scope: "row"
                }, a[e]));
                t.push({
                    tagName: "tr",
                    children: c
                })
            });
            c.push({
                tagName: "tbody",
                children: t
            });
            c = {
                tree: {
                    tagName: "table",
                    id: "highcharts-data-table-".concat(this.index),
                    children: c
                }
            };
            G(this, "aftergetTableAST", c);
            return c.tree
        };
        d.prototype.downloadCSV = function () {
            var a = this.getCSV(!0);
            K(m(a, "text/csv") || "data:text/csv,\ufeff" + encodeURIComponent(a), this.getFilename() + ".csv")
        };
        d.prototype.downloadXLS = function () {
            var a = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head>\x3c!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Ark1</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--\x3e<style>td{border:none;font-family: Calibri, sans-serif;} .number{mso-number-format:"0.00";} .text{ mso-number-format:"@";}</style><meta name=ProgId content=Excel.Sheet><meta charset=UTF-8></head><body>' +
                this.getTable(!0) + "</body></html>";
            K(m(a, "application/vnd.ms-excel") || "data:application/vnd.ms-excel;base64," + t.btoa(unescape(encodeURIComponent(a))), this.getFilename() + ".xls")
        };
        d.prototype.viewData = function () {
            this.toggleDataTable(!0)
        };
        d.prototype.hideData = function () {
            this.toggleDataTable(!1)
        };
        d.prototype.toggleDataTable = function (a) {
            (a = x(a, !this.isDataTableVisible)) && !this.dataTableDiv && (this.dataTableDiv = l.createElement("div"), this.dataTableDiv.className = "highcharts-data-table", this.renderTo.parentNode.insertBefore(this.dataTableDiv,
                this.renderTo.nextSibling));
            this.dataTableDiv && (this.dataTableDiv.style.display = a ? "block" : "none", a && (this.dataTableDiv.innerHTML = c.emptyHTML, (new c([this.getTableAST()])).addToDOM(this.dataTableDiv), G(this, "afterViewData", this.dataTableDiv)));
            this.isDataTableVisible = a;
            a = this.exportDivElements;
            var b = this.options.exporting,
                d = b && b.buttons && b.buttons.contextButton.menuItems;
            b = this.options.lang;
            C && C.menuItemDefinitions && b && b.viewData && b.hideData && d && a && (a = a[d.indexOf("viewData")]) && c.setElementHTML(a,
                this.isDataTableVisible ? b.hideData : b.viewData)
        };
        var C = p().exporting;
        C && (J(C.menuItemDefinitions, {
            downloadCSV: {
                textKey: "downloadCSV",
                onclick: function () {
                    this.downloadCSV()
                }
            },
            downloadXLS: {
                textKey: "downloadXLS",
                onclick: function () {
                    this.downloadXLS()
                }
            },
            viewData: {
                textKey: "viewData",
                onclick: function () {
                    this.toggleDataTable()
                }
            }
        }), C.buttons && C.buttons.contextButton.menuItems.push("separator", "downloadCSV", "downloadXLS", "viewData"));
        n.map && (n.map.prototype.exportKey = "name");
        n.mapbubble && (n.mapbubble.prototype.exportKey =
            "name");
        n.treemap && (n.treemap.prototype.exportKey = "name")
    });
    m(a, "masters/modules/export-data.src.js", [], function () {})
});
//# sourceMappingURL=export-data.js.map
