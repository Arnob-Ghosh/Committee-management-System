/*
 Highcharts JS v10.2.0 (2022-07-05)

 Data module

 (c) 2012-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (a) {
    "object" === typeof module && module.exports ? (a["default"] = a, module.exports = a) : "function" === typeof define && define.amd ? define("highcharts/modules/data", ["highcharts"], function (r) {
        a(r);
        a.Highcharts = r;
        return a
    }) : a("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function (a) {
    function r(a, c, y, r) {
        a.hasOwnProperty(c) || (a[c] = r.apply(null, y), "function" === typeof CustomEvent && window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded", {
            detail: {
                path: c,
                module: a[c]
            }
        })))
    }
    a = a ? a._modules : {};
    r(a, "Core/HttpUtilities.js",
        [a["Core/Globals.js"], a["Core/Utilities.js"]],
        function (a, c) {
            var r = a.doc,
                t = c.createElement,
                D = c.discardElement,
                u = c.merge,
                C = c.objectEach,
                G = {
                    ajax: function (a) {
                        var c = {
                                json: "application/json",
                                xml: "application/xml",
                                text: "text/plain",
                                octet: "application/octet-stream"
                            },
                            m = new XMLHttpRequest;
                        if (!a.url) return !1;
                        m.open((a.type || "get").toUpperCase(), a.url, !0);
                        a.headers && a.headers["Content-Type"] || m.setRequestHeader("Content-Type", c[a.dataType || "json"] || c.text);
                        C(a.headers, function (a, c) {
                            m.setRequestHeader(c, a)
                        });
                        a.responseType && (m.responseType = a.responseType);
                        m.onreadystatechange = function () {
                            if (4 === m.readyState) {
                                if (200 === m.status) {
                                    if ("blob" !== a.responseType) {
                                        var c = m.responseText;
                                        if ("json" === a.dataType) try {
                                            c = JSON.parse(c)
                                        } catch (z) {
                                            if (z instanceof Error) {
                                                a.error && a.error(m, z);
                                                return
                                            }
                                        }
                                    }
                                    return a.success && a.success(c, m)
                                }
                                a.error && a.error(m, m.responseText)
                            }
                        };
                        a.data && "string" !== typeof a.data && (a.data = JSON.stringify(a.data));
                        m.send(a.data)
                    },
                    getJSON: function (a, c) {
                        G.ajax({
                            url: a,
                            success: c,
                            dataType: "json",
                            headers: {
                                "Content-Type": "text/plain"
                            }
                        })
                    },
                    post: function (a, c, m) {
                        var y = t("form", u({
                            method: "post",
                            action: a,
                            enctype: "multipart/form-data"
                        }, m), {
                            display: "none"
                        }, r.body);
                        C(c, function (a, c) {
                            t("input", {
                                type: "hidden",
                                name: c,
                                value: a
                            }, void 0, y)
                        });
                        y.submit();
                        D(y)
                    }
                };
            "";
            return G
        });
    r(a, "Extensions/Data.js", [a["Core/Chart/Chart.js"], a["Core/Globals.js"], a["Core/HttpUtilities.js"], a["Core/Series/Point.js"], a["Core/Series/SeriesRegistry.js"], a["Core/Utilities.js"], a["Core/DefaultOptions.js"]], function (a, c, r, K, D, u, C) {
        function t(a) {
            return !(!a || !(a.rowsURL || a.csvURL ||
                a.columnsURL))
        }
        var y = c.doc,
            F = r.ajax,
            m = D.seriesTypes,
            L = C.getOptions;
        c = u.addEvent;
        var z = u.defined,
            M = u.extend,
            N = u.fireEvent,
            H = u.isNumber,
            B = u.merge,
            O = u.objectEach,
            E = u.pick,
            P = u.splat,
            J = function () {
                function a(b, g, f) {
                    void 0 === g && (g = {});
                    this.rowsToColumns = a.rowsToColumns;
                    this.dateFormats = {
                        "YYYY/mm/dd": {
                            regex: /^([0-9]{4})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{1,2})$/,
                            parser: function (b) {
                                return b ? Date.UTC(+b[1], b[2] - 1, +b[3]) : NaN
                            }
                        },
                        "dd/mm/YYYY": {
                            regex: /^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{4})$/,
                            parser: function (b) {
                                return b ?
                                    Date.UTC(+b[3], b[2] - 1, +b[1]) : NaN
                            },
                            alternative: "mm/dd/YYYY"
                        },
                        "mm/dd/YYYY": {
                            regex: /^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{4})$/,
                            parser: function (b) {
                                return b ? Date.UTC(+b[3], b[1] - 1, +b[2]) : NaN
                            }
                        },
                        "dd/mm/YY": {
                            regex: /^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{2})$/,
                            parser: function (b) {
                                if (!b) return NaN;
                                var d = +b[3];
                                d = d > (new Date).getFullYear() - 2E3 ? d + 1900 : d + 2E3;
                                return Date.UTC(d, b[2] - 1, +b[1])
                            },
                            alternative: "mm/dd/YY"
                        },
                        "mm/dd/YY": {
                            regex: /^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.]([0-9]{2})$/,
                            parser: function (b) {
                                return b ?
                                    Date.UTC(+b[3] + 2E3, b[1] - 1, +b[2]) : NaN
                            }
                        }
                    };
                    this.chart = f;
                    this.chartOptions = g;
                    this.options = b;
                    this.rawColumns = [];
                    this.init(b, g, f)
                }
                a.data = function (b, g, f) {
                    void 0 === g && (g = {});
                    return new a(b, g, f)
                };
                a.rowsToColumns = function (b) {
                    var g, f;
                    if (b) {
                        var a = [];
                        var d = b.length;
                        for (g = 0; g < d; g++) {
                            var k = b[g].length;
                            for (f = 0; f < k; f++) a[f] || (a[f] = []), a[f][g] = b[g][f]
                        }
                    }
                    return a
                };
                a.prototype.init = function (b, g, a) {
                    var f = b.decimalPoint;
                    g && (this.chartOptions = g);
                    a && (this.chart = a);
                    "." !== f && "," !== f && (f = void 0);
                    this.options = b;
                    this.columns =
                        b.columns || this.rowsToColumns(b.rows) || [];
                    this.firstRowAsNames = E(b.firstRowAsNames, this.firstRowAsNames, !0);
                    this.decimalRegex = f && new RegExp("^(-?[0-9]+)" + f + "([0-9]+)$");
                    void 0 !== this.liveDataTimeout && clearTimeout(this.liveDataTimeout);
                    this.rawColumns = [];
                    if (this.columns.length) {
                        this.dataFound();
                        var d = !t(b)
                    }
                    d || (d = this.fetchLiveData());
                    d || (d = !!this.parseCSV().length);
                    d || (d = !!this.parseTable().length);
                    d || (d = this.parseGoogleSpreadsheet());
                    !d && b.afterComplete && b.afterComplete()
                };
                a.prototype.getColumnDistribution =
                    function () {
                        var b = this.chartOptions,
                            g = this.options,
                            a = [],
                            e = function (b) {
                                return (m[b || "line"].prototype.pointArrayMap || [0]).length
                            },
                            d = b && b.chart && b.chart.type,
                            k = [],
                            h = [];
                        g = g && g.seriesMapping || b && b.series && b.series.map(function () {
                            return {
                                x: 0
                            }
                        }) || [];
                        var x = 0,
                            p;
                        (b && b.series || []).forEach(function (b) {
                            k.push(e(b.type || d))
                        });
                        g.forEach(function (b) {
                            a.push(b.x || 0)
                        });
                        0 === a.length && a.push(0);
                        g.forEach(function (g) {
                            var a = new I,
                                f = k[x] || e(d),
                                l = (b && b.series || [])[x] || {},
                                c = m[l.type || d || "line"].prototype.pointArrayMap,
                                v = c || ["y"];
                            (z(g.x) || l.isCartesian || !c) && a.addColumnReader(g.x, "x");
                            O(g, function (b, g) {
                                "x" !== g && a.addColumnReader(b, g)
                            });
                            for (p = 0; p < f; p++) a.hasReader(v[p]) || a.addColumnReader(void 0, v[p]);
                            h.push(a);
                            x++
                        });
                        g = m[d || "line"].prototype.pointArrayMap;
                        "undefined" === typeof g && (g = ["y"]);
                        this.valueCount = {
                            global: e(d),
                            xColumns: a,
                            individual: k,
                            seriesBuilders: h,
                            globalPointArrayMap: g
                        }
                    };
                a.prototype.dataFound = function () {
                    this.options.switchRowsAndColumns && (this.columns = this.rowsToColumns(this.columns));
                    this.getColumnDistribution();
                    this.parseTypes();
                    !1 !== this.parsed() && this.complete()
                };
                a.prototype.parseCSV = function (b) {
                    function g(b, g, a, d) {
                        function f(g) {
                            h = b[g];
                            c = b[g - 1];
                            m = b[g + 1]
                        }

                        function e(b) {
                            l.length < w + 1 && l.push([b]);
                            l[w][l[w].length - 1] !== b && l[w].push(b)
                        }

                        function n() {
                            x > t || t > p ? (++t, q = "") : (!isNaN(parseFloat(q)) && isFinite(q) ? (q = parseFloat(q), e("number")) : isNaN(Date.parse(q)) ? e("string") : (q = q.replace(/\//g, "-"), e("date")), k.length < w + 1 && k.push([]), a || (k[w][g] = q), q = "", ++w, ++t)
                        }
                        var A = 0,
                            h = "",
                            c = "",
                            m = "",
                            q = "",
                            t = 0,
                            w = 0;
                        if (b.trim().length &&
                            "#" !== b.trim()[0]) {
                            for (; A < b.length; A++)
                                if (f(A), '"' === h)
                                    for (f(++A); A < b.length && ('"' !== h || '"' === c || '"' === m);) {
                                        if ('"' !== h || '"' === h && '"' !== c) q += h;
                                        f(++A)
                                    } else d && d[h] ? d[h](h, q) && n() : h === v ? n() : q += h;
                            n()
                        }
                    }

                    function a(b) {
                        var g = 0,
                            a = 0,
                            f = !1;
                        b.some(function (b, d) {
                            var f = !1,
                                e = "";
                            if (13 < d) return !0;
                            for (var h = 0; h < b.length; h++) {
                                d = b[h];
                                var k = b[h + 1];
                                var c = b[h - 1];
                                if ("#" === d) break;
                                if ('"' === d)
                                    if (f) {
                                        if ('"' !== c && '"' !== k) {
                                            for (;
                                                " " === k && h < b.length;) k = b[++h];
                                            "undefined" !== typeof n[k] && n[k]++;
                                            f = !1
                                        }
                                    } else f = !0;
                                else "undefined" !== typeof n[d] ?
                                    (e = e.trim(), isNaN(Date.parse(e)) ? !isNaN(e) && isFinite(e) || n[d]++ : n[d]++, e = "") : e += d;
                                "," === d && a++;
                                "." === d && g++
                            }
                        });
                        f = n[";"] > n[","] ? ";" : ",";
                        h.decimalPoint || (h.decimalPoint = g > a ? "." : ",", d.decimalRegex = new RegExp("^(-?[0-9]+)" + h.decimalPoint + "([0-9]+)$"));
                        return f
                    }

                    function e(b, g) {
                        var a = [],
                            f = [],
                            e = [],
                            k = 0,
                            n = !1,
                            c;
                        if (!g || g > b.length) g = b.length;
                        for (; k < g; k++)
                            if ("undefined" !== typeof b[k] && b[k] && b[k].length) {
                                var l = b[k].trim().replace(/\//g, " ").replace(/\-/g, " ").replace(/\./g, " ").split(" ");
                                e = ["", "", ""];
                                for (c = 0; c <
                                    l.length; c++) c < e.length && (l[c] = parseInt(l[c], 10), l[c] && (f[c] = !f[c] || f[c] < l[c] ? l[c] : f[c], "undefined" !== typeof a[c] ? a[c] !== l[c] && (a[c] = !1) : a[c] = l[c], 31 < l[c] ? e[c] = 100 > l[c] ? "YY" : "YYYY" : 12 < l[c] && 31 >= l[c] ? (e[c] = "dd", n = !0) : e[c].length || (e[c] = "mm")))
                            } if (n) {
                            for (c = 0; c < a.length; c++) !1 !== a[c] ? 12 < f[c] && "YY" !== e[c] && "YYYY" !== e[c] && (e[c] = "YY") : 12 < f[c] && "mm" === e[c] && (e[c] = "dd");
                            3 === e.length && "dd" === e[1] && "dd" === e[2] && (e[2] = "YY");
                            b = e.join("/");
                            return (h.dateFormats || d.dateFormats)[b] ? b : (N("deduceDateFailed"), "YYYY/mm/dd")
                        }
                        return "YYYY/mm/dd"
                    }
                    var d = this,
                        k = this.columns = [],
                        h = b || this.options,
                        x = "undefined" !== typeof h.startColumn && h.startColumn ? h.startColumn : 0,
                        p = h.endColumn || Number.MAX_VALUE,
                        l = [],
                        n = {
                            ",": 0,
                            ";": 0,
                            "\t": 0
                        },
                        c = h.csv;
                    b = "undefined" !== typeof h.startRow && h.startRow ? h.startRow : 0;
                    var m = h.endRow || Number.MAX_VALUE,
                        q = 0;
                    c && h.beforeParse && (c = h.beforeParse.call(this, c));
                    if (c) {
                        c = c.replace(/\r\n/g, "\n").replace(/\r/g, "\n").split(h.lineDelimiter || "\n");
                        if (!b || 0 > b) b = 0;
                        if (!m || m >= c.length) m = c.length - 1;
                        if (h.itemDelimiter) var v = h.itemDelimiter;
                        else v =
                            null, v = a(c);
                        var t = 0;
                        for (q = b; q <= m; q++) "#" === c[q][0] ? t++ : g(c[q], q - b - t);
                        h.columnTypes && 0 !== h.columnTypes.length || !l.length || !l[0].length || "date" !== l[0][1] || h.dateFormat || (h.dateFormat = e(k[0]));
                        this.dataFound()
                    }
                    return k
                };
                a.prototype.parseTable = function () {
                    var b = this.options,
                        g = this.columns || [],
                        a = b.startRow || 0,
                        e = b.endRow || Number.MAX_VALUE,
                        d = b.startColumn || 0,
                        c = b.endColumn || Number.MAX_VALUE;
                    b.table && (b = b.table, "string" === typeof b && (b = y.getElementById(b)), [].forEach.call(b.getElementsByTagName("tr"), function (b,
                        f) {
                        f >= a && f <= e && [].forEach.call(b.children, function (b, e) {
                            var k = g[e - d],
                                h = 1;
                            if (("TD" === b.tagName || "TH" === b.tagName) && e >= d && e <= c)
                                for (g[e - d] || (g[e - d] = []), g[e - d][f - a] = b.innerHTML; f - a >= h && void 0 === k[f - a - h];) k[f - a - h] = null, h++
                        })
                    }), this.dataFound());
                    return g
                };
                a.prototype.fetchLiveData = function () {
                    function b(g) {
                        function k(c, k, l) {
                            function n() {
                                d && f.liveDataURL === c && (a.liveDataTimeout = setTimeout(b, x))
                            }
                            if (!c || !/^(http|\/|\.\/|\.\.\/)/.test(c)) return c && e.error && e.error("Invalid URL"), !1;
                            g && (clearTimeout(a.liveDataTimeout),
                                f.liveDataURL = c);
                            F({
                                url: c,
                                dataType: l || "json",
                                success: function (b) {
                                    f && f.series && k(b);
                                    n()
                                },
                                error: function (b, a) {
                                    3 > ++h && n();
                                    return e.error && e.error(a, b)
                                }
                            });
                            return !0
                        }
                        k(c.csvURL, function (b) {
                            f.update({
                                data: {
                                    csv: b
                                }
                            })
                        }, "text") || k(c.rowsURL, function (b) {
                            f.update({
                                data: {
                                    rows: b
                                }
                            })
                        }) || k(c.columnsURL, function (b) {
                            f.update({
                                data: {
                                    columns: b
                                }
                            })
                        })
                    }
                    var a = this,
                        f = this.chart,
                        e = this.options,
                        d = e.enablePolling,
                        c = B(e),
                        h = 0,
                        x = 1E3 * (e.dataRefreshRate || 2);
                    if (!t(e)) return !1;
                    1E3 > x && (x = 1E3);
                    delete e.csvURL;
                    delete e.rowsURL;
                    delete e.columnsURL;
                    b(!0);
                    return t(e)
                };
                a.prototype.parseGoogleSpreadsheet = function () {
                    function b(g) {
                        var d = ["https://sheets.googleapis.com/v4/spreadsheets", c, "values", h(), "?alt=json&majorDimension=COLUMNS&valueRenderOption=UNFORMATTED_VALUE&dateTimeRenderOption=FORMATTED_STRING&key=" + f.googleAPIKey].join("/");
                        F({
                            url: d,
                            dataType: "json",
                            success: function (d) {
                                g(d);
                                f.enablePolling && (a.liveDataTimeout = setTimeout(function () {
                                    b(g)
                                }, k))
                            },
                            error: function (b, a) {
                                return f.error && f.error(a, b)
                            }
                        })
                    }
                    var a = this,
                        f = this.options,
                        c = f.googleSpreadsheetKey,
                        d = this.chart,
                        k = Math.max(1E3 * (f.dataRefreshRate || 2), 4E3),
                        h = function () {
                            if (f.googleSpreadsheetRange) return f.googleSpreadsheetRange;
                            var b = ("ABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(f.startColumn || 0) || "A") + ((f.startRow || 0) + 1),
                                a = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(E(f.endColumn, -1)) || "ZZ";
                            z(f.endRow) && (a += f.endRow + 1);
                            return "" + b + ":".concat(a)
                        };
                    c && (delete f.googleSpreadsheetKey, b(function (b) {
                        b = b.values;
                        if (!b || 0 === b.length) return !1;
                        var g = b.reduce(function (b, a) {
                            return Math.max(b, a.length)
                        }, 0);
                        b.forEach(function (b) {
                            for (var a =
                                    0; a < g; a++) "undefined" === typeof b[a] && (b[a] = null)
                        });
                        d && d.series ? d.update({
                            data: {
                                columns: b
                            }
                        }) : (a.columns = b, a.dataFound())
                    }));
                    return !1
                };
                a.prototype.trim = function (b, a) {
                    "string" === typeof b && (b = b.replace(/^\s+|\s+$/g, ""), a && /^[0-9\s]+$/.test(b) && (b = b.replace(/\s/g, "")), this.decimalRegex && (b = b.replace(this.decimalRegex, "$1.$2")));
                    return b
                };
                a.prototype.parseTypes = function () {
                    for (var b = this.columns || [], a = b.length; a--;) this.parseColumn(b[a], a)
                };
                a.prototype.parseColumn = function (b, a) {
                    var f = this.rawColumns,
                        c = this.columns,
                        d = this.firstRowAsNames,
                        g = -1 !== this.valueCount.xColumns.indexOf(a),
                        h = [],
                        m = this.chartOptions,
                        p = (this.options.columnTypes || [])[a];
                    m = g && (m && m.xAxis && "category" === P(m.xAxis)[0].type || "string" === p);
                    var l = z(b.name),
                        n = b.length,
                        t, r;
                    for (f[a] || (f[a] = []); n--;) {
                        var q = h[n] || b[n];
                        var v = this.trim(q);
                        var u = this.trim(q, !0);
                        var w = parseFloat(u);
                        "undefined" === typeof f[a][n] && (f[a][n] = v);
                        m || 0 === n && d && !l ? b[n] = "" + v : +u === w ? (b[n] = w, 31536E6 < w && "float" !== p ? b.isDatetime = !0 : b.isNumeric = !0, "undefined" !== typeof b[n + 1] && (r = w > b[n +
                            1])) : (v && v.length && (t = this.parseDate(q)), g && H(t) && "float" !== p ? (h[n] = q, b[n] = t, b.isDatetime = !0, "undefined" !== typeof b[n + 1] && (q = t > b[n + 1], q !== r && "undefined" !== typeof r && (this.alternativeFormat ? (this.dateFormat = this.alternativeFormat, n = b.length, this.alternativeFormat = this.dateFormats[this.dateFormat].alternative) : b.unsorted = !0), r = q)) : (b[n] = "" === v ? null : v, 0 !== n && (b.isDatetime || b.isNumeric) && (b.mixed = !0)))
                    }
                    g && b.mixed && (c[a] = f[a]);
                    if (g && r && this.options.sort)
                        for (a = 0; a < c.length; a++) c[a].reverse(), d && c[a].unshift(c[a].pop())
                };
                a.prototype.parseDate = function (b) {
                    var a = this.options.parseDate,
                        c, e = this.options.dateFormat || this.dateFormat,
                        d;
                    if (a) var k = a(b);
                    else if ("string" === typeof b) {
                        if (e)(a = this.dateFormats[e]) || (a = this.dateFormats["YYYY/mm/dd"]), (d = b.match(a.regex)) && (k = a.parser(d));
                        else
                            for (c in this.dateFormats)
                                if (a = this.dateFormats[c], d = b.match(a.regex)) {
                                    this.dateFormat = c;
                                    this.alternativeFormat = a.alternative;
                                    k = a.parser(d);
                                    break
                                } d || (b.match(/:.+(GMT|UTC|[Z+-])/) && (b = b.replace(/\s*(?:GMT|UTC)?([+-])(\d\d)(\d\d)$/, "$1$2:$3").replace(/(?:\s+|GMT|UTC)([+-])/,
                            "$1").replace(/(\d)\s*(?:GMT|UTC|Z)$/, "$1+00:00")), d = Date.parse(b), "object" === typeof d && null !== d && d.getTime ? k = d.getTime() - 6E4 * d.getTimezoneOffset() : H(d) && (k = d - 6E4 * (new Date(d)).getTimezoneOffset()))
                    }
                    return k
                };
                a.prototype.getData = function () {
                    if (this.columns) return this.rowsToColumns(this.columns).slice(1)
                };
                a.prototype.parsed = function () {
                    if (this.options.parsed) return this.options.parsed.call(this, this.columns)
                };
                a.prototype.complete = function () {
                    var b = this.columns,
                        a = this.options,
                        c = [],
                        e, d, k;
                    if (a.complete ||
                        a.afterComplete) {
                        if (this.firstRowAsNames)
                            for (d = 0; d < b.length; d++) {
                                var h = b[d];
                                z(h.name) || (h.name = E(h.shift(), "").toString())
                            }
                        h = [];
                        var m = b.length;
                        var p = this.valueCount.seriesBuilders;
                        d = [];
                        var l = [];
                        for (k = 0; k < m; k += 1) d.push(!0);
                        for (m = 0; m < p.length; m += 1) {
                            var n = p[m].getReferencedColumnIndexes();
                            for (k = 0; k < n.length; k += 1) d[n[k]] = !1
                        }
                        for (k = 0; k < d.length; k += 1) d[k] && l.push(k);
                        for (d = 0; d < this.valueCount.seriesBuilders.length; d++) p = this.valueCount.seriesBuilders[d], p.populateColumns(l) && c.push(p);
                        for (; 0 < l.length;) {
                            p =
                                new I;
                            p.addColumnReader(0, "x");
                            d = l.indexOf(0); - 1 !== d && l.splice(d, 1);
                            for (d = 0; d < this.valueCount.global; d++) p.addColumnReader(void 0, this.valueCount.globalPointArrayMap[d]);
                            p.populateColumns(l) && c.push(p)
                        }
                        0 < c.length && 0 < c[0].readers.length && (l = b[c[0].readers[0].columnIndex], "undefined" !== typeof l && (l.isDatetime ? e = "datetime" : l.isNumeric || (e = "category")));
                        if ("category" === e)
                            for (d = 0; d < c.length; d++)
                                for (p = c[d], l = 0; l < p.readers.length; l++) "x" === p.readers[l].configName && (p.readers[l].configName = "name");
                        for (d =
                            0; d < c.length; d++) {
                            p = c[d];
                            l = [];
                            for (k = 0; k < b[0].length; k++) l[k] = p.read(b, k);
                            h[d] = {
                                data: l
                            };
                            p.name && (h[d].name = p.name);
                            "category" === e && (h[d].turboThreshold = 0)
                        }
                        b = {
                            series: h
                        };
                        e && (b.xAxis = {
                            type: e
                        }, "category" === e && (b.xAxis.uniqueNames = !1));
                        a.complete && a.complete(b);
                        a.afterComplete && a.afterComplete(b)
                    }
                };
                a.prototype.update = function (b, a) {
                    var c = this.chart,
                        e = c.options;
                    b && (b.afterComplete = function (b) {
                            b && (b.xAxis && c.xAxis[0] && b.xAxis.type === c.xAxis[0].options.type && delete b.xAxis, c.update(b, a, !0))
                        }, B(!0, e.data, b),
                        e.data && e.data.googleSpreadsheetKey && !b.columns && delete e.data.columns, this.init(e.data))
                };
                return a
            }();
        c(a, "init", function (a) {
            var b = this,
                c = a.args[1],
                f = L().data,
                e = a.args[0] || {};
            (f || e && e.data) && !b.hasDataDef && (b.hasDataDef = !0, f = B(f, e.data), b.data = new J(M(f, {
                afterComplete: function (a) {
                    var d;
                    if (Object.hasOwnProperty.call(e, "series"))
                        if ("object" === typeof e.series)
                            for (d = Math.max(e.series.length, a && a.series ? a.series.length : 0); d--;) {
                                var f = e.series[d] || {};
                                e.series[d] = B(f, a && a.series ? a.series[d] : {})
                            } else delete e.series;
                    e = B(a, e);
                    b.init(e, c)
                }
            }), e, b), a.preventDefault())
        });
        var I = function () {
            function a() {
                this.readers = [];
                this.pointIsArray = !0
            }
            a.prototype.populateColumns = function (b) {
                var a = !0;
                this.readers.forEach(function (a) {
                    "undefined" === typeof a.columnIndex && (a.columnIndex = b.shift())
                });
                this.readers.forEach(function (b) {
                    "undefined" === typeof b.columnIndex && (a = !1)
                });
                return a
            };
            a.prototype.read = function (b, a) {
                var c = this.pointIsArray,
                    e = c ? [] : {};
                this.readers.forEach(function (d) {
                    var f = b[d.columnIndex][a];
                    c ? e.push(f) : 0 < d.configName.indexOf(".") ?
                        K.prototype.setNestedProperty(e, f, d.configName) : e[d.configName] = f
                });
                if ("undefined" === typeof this.name && 2 <= this.readers.length) {
                    var d = this.getReferencedColumnIndexes();
                    2 <= d.length && (d.shift(), d.sort(function (b, a) {
                        return b - a
                    }), this.name = b[d.shift()].name)
                }
                return e
            };
            a.prototype.addColumnReader = function (b, a) {
                this.readers.push({
                    columnIndex: b,
                    configName: a
                });
                "x" !== a && "y" !== a && "undefined" !== typeof a && (this.pointIsArray = !1)
            };
            a.prototype.getReferencedColumnIndexes = function () {
                var b = [],
                    a;
                for (a = 0; a < this.readers.length; a +=
                    1) {
                    var c = this.readers[a];
                    "undefined" !== typeof c.columnIndex && b.push(c.columnIndex)
                }
                return b
            };
            a.prototype.hasReader = function (b) {
                var a;
                for (a = 0; a < this.readers.length; a += 1) {
                    var c = this.readers[a];
                    if (c.configName === b) return !0
                }
            };
            return a
        }();
        "";
        return J
    });
    r(a, "masters/modules/data.src.js", [a["Core/Globals.js"], a["Core/HttpUtilities.js"], a["Extensions/Data.js"]], function (a, c, r) {
        a.ajax = c.ajax;
        a.data = r.data;
        a.getJSON = c.getJSON;
        a.post = c.post;
        a.Data = r;
        a.HttpUtilities = c
    })
});
//# sourceMappingURL=data.js.map