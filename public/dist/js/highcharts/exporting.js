/*
 Highcharts JS v10.2.0 (2022-07-05)

 Exporting module

 (c) 2010-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (a) {
    "object" === typeof module && module.exports ? (a["default"] = a, module.exports = a) : "function" === typeof define && define.amd ? define("highcharts/modules/exporting", ["highcharts"], function (g) {
        a(g);
        a.Highcharts = g;
        return a
    }) : a("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function (a) {
    function g(a, e, t, n) {
        a.hasOwnProperty(e) || (a[e] = n.apply(null, t), "function" === typeof CustomEvent && window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded", {
            detail: {
                path: e,
                module: a[e]
            }
        })))
    }
    a = a ? a._modules : {};
    g(a,
        "Extensions/FullScreen.js", [a["Core/Chart/Chart.js"], a["Core/Globals.js"], a["Core/Renderer/HTML/AST.js"], a["Core/Utilities.js"]],
        function (a, e, t, n) {
            var l = n.addEvent,
                k = n.fireEvent;
            n = function () {
                function a(b) {
                    this.chart = b;
                    this.isOpen = !1;
                    b = b.renderTo;
                    this.browserProps || ("function" === typeof b.requestFullscreen ? this.browserProps = {
                        fullscreenChange: "fullscreenchange",
                        requestFullscreen: "requestFullscreen",
                        exitFullscreen: "exitFullscreen"
                    } : b.mozRequestFullScreen ? this.browserProps = {
                        fullscreenChange: "mozfullscreenchange",
                        requestFullscreen: "mozRequestFullScreen",
                        exitFullscreen: "mozCancelFullScreen"
                    } : b.webkitRequestFullScreen ? this.browserProps = {
                        fullscreenChange: "webkitfullscreenchange",
                        requestFullscreen: "webkitRequestFullScreen",
                        exitFullscreen: "webkitExitFullscreen"
                    } : b.msRequestFullscreen && (this.browserProps = {
                        fullscreenChange: "MSFullscreenChange",
                        requestFullscreen: "msRequestFullscreen",
                        exitFullscreen: "msExitFullscreen"
                    }))
                }
                a.prototype.close = function () {
                    var b = this,
                        c = b.chart,
                        a = c.options.chart;
                    k(c, "fullscreenClose", null,
                        function () {
                            if (b.isOpen && b.browserProps && c.container.ownerDocument instanceof Document) c.container.ownerDocument[b.browserProps.exitFullscreen]();
                            b.unbindFullscreenEvent && (b.unbindFullscreenEvent = b.unbindFullscreenEvent());
                            c.setSize(b.origWidth, b.origHeight, !1);
                            b.origWidth = void 0;
                            b.origHeight = void 0;
                            a.width = b.origWidthOption;
                            a.height = b.origHeightOption;
                            b.origWidthOption = void 0;
                            b.origHeightOption = void 0;
                            b.isOpen = !1;
                            b.setButtonText()
                        })
                };
                a.prototype.open = function () {
                    var b = this,
                        c = b.chart,
                        a = c.options.chart;
                    k(c, "fullscreenOpen", null, function () {
                        a && (b.origWidthOption = a.width, b.origHeightOption = a.height);
                        b.origWidth = c.chartWidth;
                        b.origHeight = c.chartHeight;
                        if (b.browserProps) {
                            var k = l(c.container.ownerDocument, b.browserProps.fullscreenChange, function () {
                                    b.isOpen ? (b.isOpen = !1, b.close()) : (c.setSize(null, null, !1), b.isOpen = !0, b.setButtonText())
                                }),
                                e = l(c, "destroy", k);
                            b.unbindFullscreenEvent = function () {
                                k();
                                e()
                            };
                            var p = c.renderTo[b.browserProps.requestFullscreen]();
                            if (p) p["catch"](function () {
                                alert("Full screen is not supported inside a frame.")
                            })
                        }
                    })
                };
                a.prototype.setButtonText = function () {
                    var b = this.chart,
                        c = b.exportDivElements,
                        a = b.options.exporting,
                        k = a && a.buttons && a.buttons.contextButton.menuItems;
                    b = b.options.lang;
                    a && a.menuItemDefinitions && b && b.exitFullscreen && b.viewFullscreen && k && c && (c = c[k.indexOf("viewFullscreen")]) && t.setElementHTML(c, this.isOpen ? b.exitFullscreen : a.menuItemDefinitions.viewFullscreen.text || b.viewFullscreen)
                };
                a.prototype.toggle = function () {
                    this.isOpen ? this.close() : this.open()
                };
                return a
            }();
            e.Fullscreen = n;
            l(a, "beforeRender", function () {
                this.fullscreen =
                    new e.Fullscreen(this)
            });
            "";
            return e.Fullscreen
        });
    g(a, "Core/Chart/ChartNavigationComposition.js", [], function () {
        var a;
        (function (a) {
            a.compose = function (a) {
                a.navigation || (a.navigation = new e(a));
                return a
            };
            var e = function () {
                function a(a) {
                    this.updates = [];
                    this.chart = a
                }
                a.prototype.addUpdate = function (a) {
                    this.chart.navigation.updates.push(a)
                };
                a.prototype.update = function (a, k) {
                    var e = this;
                    this.updates.forEach(function (b) {
                        b.call(e.chart, a, k)
                    })
                };
                return a
            }();
            a.Additions = e
        })(a || (a = {}));
        return a
    });
    g(a, "Extensions/Exporting/ExportingDefaults.js",
        [a["Core/Globals.js"]],
        function (a) {
            a = a.isTouchDevice;
            return {
                exporting: {
                    type: "image/png",
                    url: "https://export.highcharts.com/",
                    pdfFont: {
                        normal: void 0,
                        bold: void 0,
                        bolditalic: void 0,
                        italic: void 0
                    },
                    printMaxWidth: 780,
                    scale: 2,
                    buttons: {
                        contextButton: {
                            className: "highcharts-contextbutton",
                            menuClassName: "highcharts-contextmenu",
                            symbol: "menu",
                            titleKey: "contextButtonTitle",
                            menuItems: "viewFullscreen printChart separator downloadPNG downloadJPEG downloadPDF downloadSVG".split(" ")
                        }
                    },
                    menuItemDefinitions: {
                        viewFullscreen: {
                            textKey: "viewFullscreen",
                            onclick: function () {
                                this.fullscreen.toggle()
                            }
                        },
                        printChart: {
                            textKey: "printChart",
                            onclick: function () {
                                this.print()
                            }
                        },
                        separator: {
                            separator: !0
                        },
                        downloadPNG: {
                            textKey: "downloadPNG",
                            onclick: function () {
                                this.exportChart()
                            }
                        },
                        downloadJPEG: {
                            textKey: "downloadJPEG",
                            onclick: function () {
                                this.exportChart({
                                    type: "image/jpeg"
                                })
                            }
                        },
                        downloadPDF: {
                            textKey: "downloadPDF",
                            onclick: function () {
                                this.exportChart({
                                    type: "application/pdf"
                                })
                            }
                        },
                        downloadSVG: {
                            textKey: "downloadSVG",
                            onclick: function () {
                                this.exportChart({
                                    type: "image/svg+xml"
                                })
                            }
                        }
                    }
                },
                lang: {
                    viewFullscreen: "View in full screen",
                    exitFullscreen: "Exit from full screen",
                    printChart: "Print chart",
                    downloadPNG: "Download PNG image",
                    downloadJPEG: "Download JPEG image",
                    downloadPDF: "Download PDF document",
                    downloadSVG: "Download SVG vector image",
                    contextButtonTitle: "Chart context menu"
                },
                navigation: {
                    buttonOptions: {
                        symbolSize: 14,
                        symbolX: 12.5,
                        symbolY: 10.5,
                        align: "right",
                        buttonSpacing: 3,
                        height: 22,
                        verticalAlign: "top",
                        width: 24,
                        symbolFill: "#666666",
                        symbolStroke: "#666666",
                        symbolStrokeWidth: 3,
                        theme: {
                            padding: 5
                        }
                    },
                    menuStyle: {
                        border: "1px solid ".concat("#999999"),
                        background: "#ffffff",
                        padding: "5px 0"
                    },
                    menuItemStyle: {
                        padding: "0.5em 1em",
                        color: "#333333",
                        background: "none",
                        fontSize: a ? "14px" : "11px",
                        transition: "background 250ms, color 250ms"
                    },
                    menuItemHoverStyle: {
                        background: "#335cad",
                        color: "#ffffff"
                    }
                }
            }
        });
    g(a, "Extensions/Exporting/ExportingSymbols.js", [], function () {
        var a;
        (function (a) {
            function e(a, e, b, c) {
                return [
                    ["M", a, e + 2.5],
                    ["L", a + b, e + 2.5],
                    ["M", a, e + c / 2 + .5],
                    ["L", a + b, e + c / 2 + .5],
                    ["M", a, e + c - 1.5],
                    ["L", a + b, e + c - 1.5]
                ]
            }

            function l(a,
                e, b, c) {
                a = c / 3 - 2;
                c = [];
                return c = c.concat(this.circle(b - a, e, a, a), this.circle(b - a, e + a + 4, a, a), this.circle(b - a, e + 2 * (a + 4), a, a))
            }
            var g = [];
            a.compose = function (a) {
                -1 === g.indexOf(a) && (g.push(a), a = a.prototype.symbols, a.menu = e, a.menuball = l.bind(a))
            }
        })(a || (a = {}));
        return a
    });
    g(a, "Core/HttpUtilities.js", [a["Core/Globals.js"], a["Core/Utilities.js"]], function (a, e) {
        var l = a.doc,
            g = e.createElement,
            z = e.discardElement,
            k = e.merge,
            p = e.objectEach,
            b = {
                ajax: function (a) {
                    var b = {
                            json: "application/json",
                            xml: "application/xml",
                            text: "text/plain",
                            octet: "application/octet-stream"
                        },
                        c = new XMLHttpRequest;
                    if (!a.url) return !1;
                    c.open((a.type || "get").toUpperCase(), a.url, !0);
                    a.headers && a.headers["Content-Type"] || c.setRequestHeader("Content-Type", b[a.dataType || "json"] || b.text);
                    p(a.headers, function (a, b) {
                        c.setRequestHeader(b, a)
                    });
                    a.responseType && (c.responseType = a.responseType);
                    c.onreadystatechange = function () {
                        if (4 === c.readyState) {
                            if (200 === c.status) {
                                if ("blob" !== a.responseType) {
                                    var b = c.responseText;
                                    if ("json" === a.dataType) try {
                                        b = JSON.parse(b)
                                    } catch (x) {
                                        if (x instanceof Error) {
                                            a.error && a.error(c, x);
                                            return
                                        }
                                    }
                                }
                                return a.success && a.success(b, c)
                            }
                            a.error && a.error(c, c.responseText)
                        }
                    };
                    a.data && "string" !== typeof a.data && (a.data = JSON.stringify(a.data));
                    c.send(a.data)
                },
                getJSON: function (a, e) {
                    b.ajax({
                        url: a,
                        success: e,
                        dataType: "json",
                        headers: {
                            "Content-Type": "text/plain"
                        }
                    })
                },
                post: function (a, b, e) {
                    var c = g("form", k({
                        method: "post",
                        action: a,
                        enctype: "multipart/form-data"
                    }, e), {
                        display: "none"
                    }, l.body);
                    p(b, function (a, b) {
                        g("input", {
                            type: "hidden",
                            name: b,
                            value: a
                        }, void 0, c)
                    });
                    c.submit();
                    z(c)
                }
            };
        "";
        return b
    });
    g(a, "Extensions/Exporting/Exporting.js", [a["Core/Renderer/HTML/AST.js"], a["Core/Chart/Chart.js"], a["Core/Chart/ChartNavigationComposition.js"], a["Core/DefaultOptions.js"], a["Extensions/Exporting/ExportingDefaults.js"], a["Extensions/Exporting/ExportingSymbols.js"], a["Core/Globals.js"], a["Core/HttpUtilities.js"], a["Core/Utilities.js"]], function (a, e, g, n, z, k, p, b, c) {
        e = n.defaultOptions;
        var l = p.doc,
            t = p.SVG_NS,
            A = p.win,
            x = c.addEvent,
            v = c.css,
            C = c.createElement,
            J = c.discardElement,
            D = c.extend,
            N = c.find,
            E = c.fireEvent,
            O = c.isObject,
            q = c.merge,
            P = c.objectEach,
            y = c.pick,
            Q = c.removeEvent,
            R = c.uniqueKey,
            F;
        (function (e) {
            function n(a) {
                var d = this,
                    b = d.renderer,
                    c = q(d.options.navigation.buttonOptions, a),
                    e = c.onclick,
                    m = c.menuItems,
                    r = c.symbolSize || 12;
                d.btnCount || (d.btnCount = 0);
                d.exportDivElements || (d.exportDivElements = [], d.exportSVGElements = []);
                if (!1 !== c.enabled && c.theme) {
                    var f = c.theme,
                        I;
                    d.styledMode || (f.fill = y(f.fill, "#ffffff"), f.stroke = y(f.stroke, "none"));
                    e ? I = function (a) {
                        a && a.stopPropagation();
                        e.call(d, a)
                    } : m && (I = function (a) {
                        a &&
                            a.stopPropagation();
                        d.contextMenu(u.menuClassName, m, u.translateX, u.translateY, u.width, u.height, u);
                        u.setState(2)
                    });
                    c.text && c.symbol ? f.paddingLeft = y(f.paddingLeft, 30) : c.text || D(f, {
                        width: c.width,
                        height: c.height,
                        padding: 0
                    });
                    d.styledMode || (f["stroke-linecap"] = "round", f.fill = y(f.fill, "#ffffff"), f.stroke = y(f.stroke, "none"));
                    var u = b.button(c.text, 0, 0, I, f).addClass(a.className).attr({
                        title: y(d.options.lang[c._titleKey || c.titleKey], "")
                    });
                    u.menuClassName = a.menuClassName || "highcharts-menu-" + d.btnCount++;
                    if (c.symbol) {
                        var l =
                            b.symbol(c.symbol, c.symbolX - r / 2, c.symbolY - r / 2, r, r, {
                                width: r,
                                height: r
                            }).addClass("highcharts-button-symbol").attr({
                                zIndex: 1
                            }).add(u);
                        d.styledMode || l.attr({
                            stroke: c.symbolStroke,
                            fill: c.symbolFill,
                            "stroke-width": c.symbolStrokeWidth || 1
                        })
                    }
                    u.add(d.exportingGroup).align(D(c, {
                        width: u.width,
                        x: y(c.x, d.buttonOffset)
                    }), !0, "spacingBox");
                    d.buttonOffset += (u.width + c.buttonSpacing) * ("right" === c.align ? -1 : 1);
                    d.exportSVGElements.push(u, l)
                }
            }

            function z() {
                if (this.printReverseInfo) {
                    var a = this.printReverseInfo,
                        c = a.childNodes,
                        b = a.origDisplay;
                    a = a.resetParams;
                    this.moveContainers(this.renderTo);
                    [].forEach.call(c, function (a, d) {
                        1 === a.nodeType && (a.style.display = b[d] || "")
                    });
                    this.isPrinting = !1;
                    a && this.setSize.apply(this, a);
                    delete this.printReverseInfo;
                    G = void 0;
                    E(this, "afterPrint")
                }
            }

            function F() {
                var a = l.body,
                    c = this.options.exporting.printMaxWidth,
                    b = {
                        childNodes: a.childNodes,
                        origDisplay: [],
                        resetParams: void 0
                    };
                this.isPrinting = !0;
                this.pointer.reset(null, 0);
                E(this, "beforePrint");
                c && this.chartWidth > c && (b.resetParams = [this.options.chart.width,
                    void 0, !1
                ], this.setSize(c, void 0, !1));
                [].forEach.call(b.childNodes, function (a, d) {
                    1 === a.nodeType && (b.origDisplay[d] = a.style.display, a.style.display = "none")
                });
                this.moveContainers(a);
                this.printReverseInfo = b
            }

            function S(a) {
                a.renderExporting();
                x(a, "redraw", a.renderExporting);
                x(a, "destroy", a.destroyExport)
            }

            function T(d, b, e, H, K, m, r) {
                var f = this,
                    w = f.options.navigation,
                    B = f.chartWidth,
                    g = f.chartHeight,
                    p = "cache-" + d,
                    k = Math.max(K, m),
                    h = f[p];
                if (!h) {
                    f.exportContextMenu = f[p] = h = C("div", {
                        className: d
                    }, {
                        position: "absolute",
                        zIndex: 1E3,
                        padding: k + "px",
                        pointerEvents: "auto"
                    }, f.fixedDiv || f.container);
                    var q = C("ul", {
                        className: "highcharts-menu"
                    }, {
                        listStyle: "none",
                        margin: 0,
                        padding: 0
                    }, h);
                    f.styledMode || v(q, D({
                        MozBoxShadow: "3px 3px 10px #888",
                        WebkitBoxShadow: "3px 3px 10px #888",
                        boxShadow: "3px 3px 10px #888"
                    }, w.menuStyle));
                    h.hideMenu = function () {
                        v(h, {
                            display: "none"
                        });
                        r && r.setState(0);
                        f.openMenu = !1;
                        v(f.renderTo, {
                            overflow: "hidden"
                        });
                        v(f.container, {
                            overflow: "hidden"
                        });
                        c.clearTimeout(h.hideTimer);
                        E(f, "exportMenuHidden")
                    };
                    f.exportEvents.push(x(h,
                        "mouseleave",
                        function () {
                            h.hideTimer = A.setTimeout(h.hideMenu, 500)
                        }), x(h, "mouseenter", function () {
                        c.clearTimeout(h.hideTimer)
                    }), x(l, "mouseup", function (a) {
                        f.pointer.inClass(a.target, d) || h.hideMenu()
                    }), x(h, "click", function () {
                        f.openMenu && h.hideMenu()
                    }));
                    b.forEach(function (d) {
                        "string" === typeof d && (d = f.options.exporting.menuItemDefinitions[d]);
                        if (O(d, !0)) {
                            var b = void 0;
                            d.separator ? b = C("hr", void 0, void 0, q) : ("viewData" === d.textKey && f.isDataTableVisible && (d.textKey = "hideData"), b = C("li", {
                                className: "highcharts-menu-item",
                                onclick: function (a) {
                                    a && a.stopPropagation();
                                    h.hideMenu();
                                    d.onclick && d.onclick.apply(f, arguments)
                                }
                            }, void 0, q), a.setElementHTML(b, d.text || f.options.lang[d.textKey]), f.styledMode || (b.onmouseover = function () {
                                v(this, w.menuItemHoverStyle)
                            }, b.onmouseout = function () {
                                v(this, w.menuItemStyle)
                            }, v(b, D({
                                cursor: "pointer"
                            }, w.menuItemStyle || {}))));
                            f.exportDivElements.push(b)
                        }
                    });
                    f.exportDivElements.push(q, h);
                    f.exportMenuWidth = h.offsetWidth;
                    f.exportMenuHeight = h.offsetHeight
                }
                b = {
                    display: "block"
                };
                e + f.exportMenuWidth > B ? b.right =
                    B - e - K - k + "px" : b.left = e - k + "px";
                H + m + f.exportMenuHeight > g && "top" !== r.alignOptions.verticalAlign ? b.bottom = g - H - k + "px" : b.top = H + m - k + "px";
                v(h, b);
                v(f.renderTo, {
                    overflow: ""
                });
                v(f.container, {
                    overflow: ""
                });
                f.openMenu = !0;
                E(f, "exportMenuShown")
            }

            function U(a) {
                var d = a ? a.target : this,
                    b = d.exportSVGElements,
                    e = d.exportDivElements;
                a = d.exportEvents;
                var l;
                b && (b.forEach(function (a, c) {
                    a && (a.onclick = a.ontouchstart = null, l = "cache-" + a.menuClassName, d[l] && delete d[l], b[c] = a.destroy())
                }), b.length = 0);
                d.exportingGroup && (d.exportingGroup.destroy(),
                    delete d.exportingGroup);
                e && (e.forEach(function (a, d) {
                    a && (c.clearTimeout(a.hideTimer), Q(a, "mouseleave"), e[d] = a.onmouseout = a.onmouseover = a.ontouchstart = a.onclick = null, J(a))
                }), e.length = 0);
                a && (a.forEach(function (a) {
                    a()
                }), a.length = 0)
            }

            function V(a, c) {
                c = this.getSVGForExport(a, c);
                a = q(this.options.exporting, a);
                b.post(a.url, {
                    filename: a.filename ? a.filename.replace(/\//g, "-") : this.getFilename(),
                    type: a.type,
                    width: a.width || 0,
                    scale: a.scale,
                    svg: c
                }, a.formAttributes)
            }

            function W() {
                this.styledMode && this.inlineStyles();
                return this.container.innerHTML
            }

            function X() {
                var a = this.userOptions.title && this.userOptions.title.text,
                    b = this.options.exporting.filename;
                if (b) return b.replace(/\//g, "-");
                "string" === typeof a && (b = a.toLowerCase().replace(/<\/?[^>]+(>|$)/g, "").replace(/[\s_]+/g, "-").replace(/[^a-z0-9\-]/g, "").replace(/^[\-]+/g, "").replace(/[\-]+/g, "-").substr(0, 24).replace(/[\-]+$/g, ""));
                if (!b || 5 > b.length) b = "chart";
                return b
            }

            function Y(a) {
                var b, d = q(this.options, a);
                d.plotOptions = q(this.userOptions.plotOptions, a && a.plotOptions);
                d.time = q(this.userOptions.time, a && a.time);
                var c = C("div", null, {
                        position: "absolute",
                        top: "-9999em",
                        width: this.chartWidth + "px",
                        height: this.chartHeight + "px"
                    }, l.body),
                    e = this.renderTo.style.width;
                var m = this.renderTo.style.height;
                e = d.exporting.sourceWidth || d.chart.width || /px$/.test(e) && parseInt(e, 10) || (d.isGantt ? 800 : 600);
                m = d.exporting.sourceHeight || d.chart.height || /px$/.test(m) && parseInt(m, 10) || 400;
                D(d.chart, {
                    animation: !1,
                    renderTo: c,
                    forExport: !0,
                    renderer: "SVGRenderer",
                    width: e,
                    height: m
                });
                d.exporting.enabled = !1;
                delete d.data;
                d.series = [];
                this.series.forEach(function (a) {
                    b = q(a.userOptions, {
                        animation: !1,
                        enableMouseTracking: !1,
                        showCheckbox: !1,
                        visible: a.visible
                    });
                    b.isInternal || d.series.push(b)
                });
                var g = {};
                this.axes.forEach(function (a) {
                    a.userOptions.internalKey || (a.userOptions.internalKey = R());
                    a.options.isInternal || (g[a.coll] || (g[a.coll] = !0, d[a.coll] = []), d[a.coll].push(q(a.userOptions, {
                        visible: a.visible
                    })))
                });
                var f = new this.constructor(d, this.callback);
                a && ["xAxis", "yAxis", "series"].forEach(function (d) {
                    var b = {};
                    a[d] && (b[d] = a[d], f.update(b))
                });
                this.axes.forEach(function (a) {
                    var d = N(f.axes, function (d) {
                            return d.options.internalKey === a.userOptions.internalKey
                        }),
                        b = a.getExtremes(),
                        c = b.userMin;
                    b = b.userMax;
                    d && ("undefined" !== typeof c && c !== d.min || "undefined" !== typeof b && b !== d.max) && d.setExtremes(c, b, !0, !1)
                });
                m = f.getChartHTML();
                E(this, "getSVG", {
                    chartCopy: f
                });
                m = this.sanitizeSVG(m, d);
                d = null;
                f.destroy();
                J(c);
                return m
            }

            function Z(a, b) {
                var d = this.options.exporting;
                return this.getSVG(q({
                        chart: {
                            borderRadius: 0
                        }
                    }, d.chartOptions,
                    b, {
                        exporting: {
                            sourceWidth: a && a.sourceWidth || d.sourceWidth,
                            sourceHeight: a && a.sourceHeight || d.sourceHeight
                        }
                    }))
            }

            function aa(a) {
                return a.replace(/([A-Z])/g, function (a, b) {
                    return "-" + b.toLowerCase()
                })
            }

            function ba() {
                function a(d) {
                    var e = {},
                        f, w;
                    if (r && 1 === d.nodeType && -1 === ca.indexOf(d.nodeName)) {
                        var l = A.getComputedStyle(d, null);
                        var m = "svg" === d.nodeName ? {} : A.getComputedStyle(d.parentNode, null);
                        if (!g[d.nodeName]) {
                            k = r.getElementsByTagName("svg")[0];
                            var h = r.createElementNS(d.namespaceURI, d.nodeName);
                            k.appendChild(h);
                            g[d.nodeName] = q(A.getComputedStyle(h, null));
                            "text" === d.nodeName && delete g.text.fill;
                            k.removeChild(h)
                        }
                        for (var B in l)
                            if (p.isFirefox || p.isMS || p.isSafari || Object.hasOwnProperty.call(l, B)) {
                                var t = l[B],
                                    n = B;
                                h = f = !1;
                                if (c.length) {
                                    for (w = c.length; w-- && !f;) f = c[w].test(n);
                                    h = !f
                                }
                                "transform" === n && "none" === t && (h = !0);
                                for (w = b.length; w-- && !h;) h = b[w].test(n) || "function" === typeof t;
                                h || m[n] === t && "svg" !== d.nodeName || g[d.nodeName][n] === t || (L && -1 === L.indexOf(n) ? "parentRule" !== n && (e[n] = t) : t && d.setAttribute(aa(n), t))
                            } v(d, e);
                        "svg" === d.nodeName && d.setAttribute("stroke-width", "1px");
                        "text" !== d.nodeName && [].forEach.call(d.children || d.childNodes, a)
                    }
                }
                var b = da,
                    c = e.inlineWhitelist,
                    g = {},
                    k, m = l.createElement("iframe");
                v(m, {
                    width: "1px",
                    height: "1px",
                    visibility: "hidden"
                });
                l.body.appendChild(m);
                var r = m.contentWindow && m.contentWindow.document;
                r && r.body.appendChild(r.createElementNS(t, "svg"));
                a(this.container.querySelector("svg"));
                k.parentNode.removeChild(k);
                m.parentNode.removeChild(m)
            }

            function ea(a) {
                (this.fixedDiv ? [this.fixedDiv, this.scrollingContainer] : [this.container]).forEach(function (d) {
                    a.appendChild(d)
                })
            }

            function fa() {
                var a = this;
                a.exporting = {
                    update: function (d, b) {
                        a.isDirtyExporting = !0;
                        q(!0, a.options.exporting, d);
                        y(b, !0) && a.redraw()
                    }
                };
                g.compose(a).navigation.addUpdate(function (d, b) {
                    a.isDirtyExporting = !0;
                    q(!0, a.options.navigation, d);
                    y(b, !0) && a.redraw()
                })
            }

            function ha() {
                var a = this;
                a.isPrinting || (G = a, p.isSafari || a.beforePrint(), setTimeout(function () {
                    A.focus();
                    A.print();
                    p.isSafari || setTimeout(function () {
                        a.afterPrint()
                    }, 1E3)
                }, 1))
            }

            function ia() {
                var a =
                    this,
                    b = a.options.exporting,
                    c = b.buttons,
                    e = a.isDirtyExporting || !a.exportSVGElements;
                a.buttonOffset = 0;
                a.isDirtyExporting && a.destroyExport();
                e && !1 !== b.enabled && (a.exportEvents = [], a.exportingGroup = a.exportingGroup || a.renderer.g("exporting-group").attr({
                    zIndex: 3
                }).add(), P(c, function (b) {
                    a.addButton(b)
                }), a.isDirtyExporting = !1)
            }

            function ja(a, b) {
                var c = a.indexOf("</svg>") + 6,
                    d = a.substr(c);
                a = a.substr(0, c);
                b && b.exporting && b.exporting.allowHTML && d && (d = '<foreignObject x="0" y="0" width="' + b.chart.width + '" height="' +
                    b.chart.height + '"><body xmlns="http://www.w3.org/1999/xhtml">' + d.replace(/(<(?:img|br).*?(?=>))>/g, "$1 />") + "</body></foreignObject>", a = a.replace("</svg>", d + "</svg>"));
                a = a.replace(/zIndex="[^"]+"/g, "").replace(/symbolName="[^"]+"/g, "").replace(/jQuery[0-9]+="[^"]+"/g, "").replace(/url\(("|&quot;)(.*?)("|&quot;);?\)/g, "url($2)").replace(/url\([^#]+#/g, "url(#").replace(/<svg /, '<svg xmlns:xlink="http://www.w3.org/1999/xlink" ').replace(/ (|NS[0-9]+:)href=/g, " xlink:href=").replace(/\n/, " ").replace(/(fill|stroke)="rgba\(([ 0-9]+,[ 0-9]+,[ 0-9]+),([ 0-9\.]+)\)"/g,
                    '$1="rgb($2)" $1-opacity="$3"').replace(/&nbsp;/g, "\u00a0").replace(/&shy;/g, "\u00ad");
                this.ieSanitizeSVG && (a = this.ieSanitizeSVG(a));
                return a
            }
            var M = [],
                da = [/-/, /^(clipPath|cssText|d|height|width)$/, /^font$/, /[lL]ogical(Width|Height)$/, /perspective/, /TapHighlightColor/, /^transition/, /^length$/],
                L = "fill stroke strokeLinecap strokeLinejoin strokeWidth textAnchor x y".split(" ");
            e.inlineWhitelist = [];
            var ca = ["clipPath", "defs", "desc"],
                G;
            e.compose = function (a, b) {
                k.compose(b); - 1 === M.indexOf(a) && (M.push(a),
                    b = a.prototype, b.afterPrint = z, b.exportChart = V, b.inlineStyles = ba, b.print = ha, b.sanitizeSVG = ja, b.getChartHTML = W, b.getSVG = Y, b.getSVGForExport = Z, b.getFilename = X, b.moveContainers = ea, b.beforePrint = F, b.contextMenu = T, b.addButton = n, b.destroyExport = U, b.renderExporting = ia, b.callbacks.push(S), x(a, "init", fa), p.isSafari && p.win.matchMedia("print").addListener(function (a) {
                        G && (a.matches ? G.beforePrint() : G.afterPrint())
                    }))
            }
        })(F || (F = {}));
        e.exporting = q(z.exporting, e.exporting);
        e.lang = q(z.lang, e.lang);
        e.navigation = q(z.navigation,
            e.navigation);
        "";
        "";
        return F
    });
    g(a, "masters/modules/exporting.src.js", [a["Core/Globals.js"], a["Extensions/Exporting/Exporting.js"], a["Core/HttpUtilities.js"]], function (a, e, g) {
        a.HttpUtilities = g;
        a.ajax = g.ajax;
        a.getJSON = g.getJSON;
        a.post = g.post;
        e.compose(a.Chart, a.Renderer)
    })
});
//# sourceMappingURL=exporting.js.map
