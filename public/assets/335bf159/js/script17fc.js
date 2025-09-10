$(document).ready(function () {
    if ($('.marquee').length > 0) {
        $('.marquee').map(function () {
            $(this).marquee({
                duration: 20000,
                gap: 0,
                delayBeforeStart: 0,
                duplicated: true,
                startVisible: true
            })
        })

    }

    if ($('.tltpBtn').length > 0) {
        $('.tltpBtn').map(function () {
            let content = $(this).siblings('.tltpContent')
            $(this).tooltipster({
                functionReady: function (instance, helper) {
                    $(helper.origin).addClass('active')
                },
                functionAfter: function (instance, helper) {
                    $(helper.origin).removeClass('active')
                },
                content: content,
                trigger: 'custom',
                triggerOpen: {
                    mouseenter: true,
                    tap: true,
                },
                triggerClose: {
                    mouseleave: true
                },
                distance: 5,
                zIndex: 100,
                animationDuration: [300, 100],
                contentCloning: false,
                positionTracker: true,
                maxWidth: 324,
                contentAsHTML: true
            })

            $(this).on('click', function (e) {
                e.preventDefault()
                e.stopPropagation()
            })
        })
    }

    if ($('.tabsList').length > 0) {
        $('.tabsList').map(function () {
            let isHash = $(this).hasClass('hashTabs') && window.location.hash != undefined
            let linksObj = $(this).find('a, label')
            let links = Array.from(linksObj)
            let hashLink = links.find(link => $(link).attr('href') == window.location.hash)
            let activeLink = links.find(link => $(link).hasClass('active'))

            if (isHash && hashLink) {
                if (activeLink !== undefined) {
                    let activeContent = $($(activeLink).attr('href'))
                    $(activeLink).removeClass('active')
                    activeContent.removeClass('opening').removeClass('active')
                }
                activeLink = hashLink
                $(activeLink).addClass('active')
            } else {
                if (activeLink == undefined) {
                    activeLink = Array.from(links)[0]
                    $(activeLink).addClass('active')
                    if ($(activeLink).siblings('input').length > 0) {
                        $(activeLink).trigger('click')
                    }
                } else {
                    if ($(activeLink).siblings('input').length > 0) {
                        $(activeLink).trigger('click')
                    }
                }
            }
            let id = $(activeLink).attr('href') || '#' + $(activeLink).attr('data-href')
            let content = $(id)
            if (!content.hasClass('active')) {
                content.addClass('active')
            }
            linksObj.on('click', function (e) {
                if ($(this).attr('href') !== undefined) {
                    e.preventDefault()
                }

                if ($(this).attr('href') !== undefined || $(this).attr('data-href') !== undefined) {
                    let clickedLink = $(this)
                    let newId = clickedLink.attr('href') || '#' + clickedLink.attr('data-href')

                    if (!clickedLink.hasClass('active')) {
                        activeLink = links.find(link => $(link).hasClass('active'))
                        if ($(activeLink).length > 0) {
                            id = $(activeLink).attr('href') || '#' + $(activeLink).attr('data-href')
                            content = $(id)
                            $(activeLink).removeClass('active')
                            console.log('click', id)
                            content.removeClass('opening').removeClass('active')
                        }
                        if (isHash) {
                            history.replaceState({}, '', newId);
                        }
                        clickedLink.addClass('active')
                        $(newId).addClass('opening')
                        setTimeout(function () {
                            $(newId).removeClass('opening').addClass('active')
                        }, 100)
                    }
                }
            })
            if (isHash) {
                window.addEventListener('hashchange', function () {
                    hashLink = links.find(link => $(link).attr('href') == window.location.hash)
                    if (hashLink !== undefined) {
                        activeLink = links.find(link => $(link).hasClass('active'))
                        let activeContent = $($(activeLink).attr('href'))
                        $(activeLink).removeClass('active')
                        activeContent.removeClass('opening').removeClass('active')
                        let newContent = $($(hashLink).attr('href'))
                        $(hashLink).addClass('active')
                        newContent.addClass('opening')
                        setTimeout(function () {
                            newContent.removeClass('opening').addClass('active')
                        }, 100)
                    }
                })
            }
        })
    }

    if ($('canvas.dots').length > 0) {
        document.querySelectorAll('canvas.dots').forEach(dots => {
            flyingDots(dots, 'build')
        })
    }

    if ($('.inputContainer select').length > 0) {
        $('.inputContainer select').map(function () {
            var select = $(this)
            select.selectric({
                arrowButtonMarkup: '<span class="icon icon-carret"></span>',
                labelBuilder: function (item) {
                    let icon = $(item.element).attr('data-icon')
                    //let short = $(item.element).attr('data-short')
                    return select.hasClass('payment')
                        ? `<div class='payIcon'><img src="${icon}" alt="${item.text}"></div> ${item.text}`
                        : item.text
                },
                optionsItemBuilder: function (item) {
                    let icon = $(item.element).attr('data-icon')
                    let alt = $(item.element).attr('data-alt')
                    //let short = $(item.element).attr('data-short')
                    return select.hasClass('payment')
                        ? `<div class='payIcon'><img src="${icon}" alt="${item.text}"></div> ${item.text}`
                        : item.text
                },
            });
        })
    }

    if ($('.accordItem').length > 0) {
        $('.accordTitle').on('click', function (e) {
            e.preventDefault()
            let item = $(this)
            let list = item.parents('.accordList')
            let content = item.siblings('.accordContent')
            if (item.hasClass('active')) {
                content.stop().slideUp(300)
                item.removeClass('active')
            } else {
                if (list.length > 0) {
                    let active = list.find('.accordTitle.active')
                    if (active.length > 0 && !item.hasClass('active')) {
                        active.siblings('.accordContent').stop().slideUp(300)
                        active.removeClass('active')
                    }
                }
                item.addClass('active')
                content.stop().slideDown(300)
            }
        })
    }

    if ($('.langContainer').length > 0) {
        $('.langContainer').map(function () {
            const container = $(this)[0]
            const removeListeners = () => {
                container.classList.remove('active')
                window.removeEventListener("click", handleMenu)
                window.removeEventListener("keydown", handleMenu)
            }
            function handleMenu(e) {
                if (e.type == 'click') {
                    clickOutToClose(e, container, removeListeners)
                } else if (e.type == 'keydown') {
                    clickEscToClose(e, removeListeners)
                }
            }
            $(this).children('.langHead').on('click', function (e) {
                e.preventDefault()
                if (!container.classList.contains('active')) {
                    container.classList.add('active')
                    window.addEventListener("click", handleMenu)
                    window.addEventListener("keydown", handleMenu)

                } else {
                    removeListeners()
                }
            })
        })
    }

    if ($('[data-menu-btn]').length > 0) {
        $('[data-menu-btn]').map(function () {
            const id = $(this).attr('data-menu-btn')
            const content = $('[data-menu=' + id + ']')
            addMenuEvents({
                btn: $(this),
                content: content,
                closeDirection: id == 'cabMenu' ? 'toLeft' : 'toRight'
            })
        })
    }

    if ($('.copyContainer, .valCopyContainer').length > 0) {
        $(".copyContainer, .valCopyContainer").map(function () {
            const container = $(this)
            const btn = container.find('.btnCopy')
            const clipboard = new ClipboardJS(btn[0])

            btn.on('click', function (e) {
                e.preventDefault()
            })

            clipboard.on('success', function () {
                container.find('.copyMessage').addClass('active')
                setTimeout(function () {
                    container.find('.copyMessage').removeClass('active')
                }, 2000)
            });
        })
    }

    if ($('[data-check-select]').length > 0) {
        $('[data-check-select]').map(function () {
            let id = $(this).attr('data-check-select')
            $(this).find('input').on('change', function () {
                let val = $(this).val()
                let index = $('[data-check-select="' + id + '"]').find('select option[value="' + val + '"]').index()
                $('[data-check-select="' + id + '"] select').prop('selectedIndex', index).selectric('refresh');
            })
            $(this).find('select').on('change', function () {
                let val = $(this).val()
                $('[data-check-select="' + id + '"] input[value="' + val + '"]').prop('checked', true).change();
            })
        })
    }



    if ($(".filterDates").length > 0) {
        $(".filterDates").map(function () {
            const elem = $(this)[0]
            Datepicker.locales.ru = {
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                today: "Сегодня",
                clear: "Очистить",
                format: "dd.mm.yyyy",
                weekStart: 1,
                monthsTitle: 'Месяцы'
            }
            const datepicker = new DateRangePicker(elem, {
                autohide: true,
                language: $(elem).attr('data-lang') !== undefined ? $(elem).attr('data-lang') : 'en',
                nextArrow: '<span class="icon icon-right"></span>',
                prevArrow: '<span class="icon icon-left"></span>'
            })
        })
    }

    if ($(".formSwitcher").length > 0) {
        $(".formSwitcher").map(function () {
            const input = $(this).find('input[type="checkbox"]')
            const name = input.attr('id')
            const content = Array.from($('[data-switcher="' + name + '"]'))
            $(content.find(item => item.dataset.state == String(input.is(':checked')))).prop('checked', true).change()

            input.on('change', function () {
                $(content.find(item => item.dataset.state == String(input.is(':checked')))).prop('checked', true).change()
                content.map(function () {
                    $(this).change()
                })
            })
        })
    }

    if ($('[data-micromodal-trigger]').length > 0) {
        $('[data-micromodal-trigger]').on('click', function (e) {
            e.preventDefault()
        })
        $('[data-micromodal-close]').on('click', function (e) {
            e.preventDefault()
        })
        MicroModal.init({
            onShow: modal => {
                $('body').addClass('bodyModal')
            },
            onClose: modal => {
                setTimeout(function () {
                    $('body').removeClass('bodyModal')
                    if ($(modal).find('video').length > 0) {
                        $(modal).find('video')[0].pause();
                    }
                }, 300)
            },
            disableFocus: true,
            awaitOpenAnimation: true,
            awaitCloseAnimation: true,
            disableScroll: true,
        })
    }

    // CABINET SCRIPTS

    if ($('.cabDropdown').length > 0) {
        $('.cabDropdown').map(function () {
            const el = $(this);
            const container = el[0]
            const removeListeners = () => {
                el.children('.list').stop().fadeOut(300)
                container.classList.remove('active')
                window.removeEventListener("click", handleMenu)
                window.removeEventListener("keydown", handleMenu)
            }
            function handleMenu(e) {
                if (e.type == 'click') {
                    clickOutToClose(e, container, removeListeners)
                } else if (e.type == 'keydown') {
                    clickEscToClose(e, removeListeners)
                }
            }
            $(this).children('.head').on('click', function (e) {
                e.preventDefault()
                if (!container.classList.contains('active')) {
                    container.classList.add('active')
                    el.children('.list').stop().fadeIn(300)
                    window.addEventListener("click", handleMenu)
                    window.addEventListener("keydown", handleMenu)

                } else {
                    el.children('.list').stop().fadeOut(300)
                    removeListeners()
                }
            })
        })
    }

    if ($('.cabTimer').length > 0) {
        let m
        const timer = function () {
            let now = new Date($(this).attr('data-now')),
                startTime = new Date($(this).attr('data-start')),
                finishTime = new Date($(this).attr('data-end')),
                startMS = startTime.getTime(),
                finishMS = finishTime.getTime(),
                nowMS = now.getTime(),
                betweenMS = finishMS - startMS,
                lastMS = finishMS - nowMS,
                percent = lastMS * 100 / betweenMS,
                lastDay,
                lastHour,
                lastMin,
                lastSec;
            percent = 100 - percent.toFixed();

            m = setInterval(function () {
                nowMS = nowMS + 1000;
                lastMS = finishMS - nowMS;

                lastSec = Math.floor((lastMS / 1000) % 60);
                lastMin = Math.floor((lastMS / 1000 / 60) % 60);
                lastHour = Math.floor((lastMS / (1000 * 60 * 60)) % 24);
                lastDay = Math.floor(lastMS / (1000 * 60 * 60 * 24));

                lastDay = checkTime(lastDay);
                lastHour = checkTime(lastHour);
                lastMin = checkTime(lastMin);
                lastSec = checkTime(lastSec);

                $(this).html(`${lastDay} : ${lastHour} : ${lastMin} : ${lastSec}`)

                if (lastMS / 1000 < 0) {
                    $(this).html(`00 : 00 : 00 : 00`)
                }

            }.bind(this), 1000)
        };

        const checkTime = function (i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        }
        $('.cabTimer').map(timer)
    }

    if ($('.cabClock').length > 0) {
        $('.cabClock').map(function () {
            let el = $(this),
                timeEl = el.find('.time'),
                dateEl = el.find('.date')
            function clock() {
                var date = new Date(),
                    day = date.getDate(),
                    month = date.getMonth(),
                    monthArr = dateEl.attr('data-months').split(','),
                    year = date.getFullYear(),
                    hour = date.getHours(),
                    min = date.getMinutes(),
                    sec = date.getSeconds(),
                    ampm = hour >= 12 ? 'pm' : 'am';

                hour = hour % 12;
                hour = hour ? hour : 12;

                if (hour < 10) hour = '0' + hour;
                if (min < 10) min = '0' + min;
                if (sec < 10) sec = '0' + sec;

                dateEl.html(monthArr[month] + ' ' + day + ', ' + year);
                timeEl.html(hour + ':' + min + ' ' + ampm);
            }

            function clockStart() {
                setInterval(clock, 1000);
            }

            clockStart();
        })
    }

    if ($('.dropdownItem').length > 0) {
        let dropHead = $('.dropdownItem > .head'),
            dropContent = $('.dropdownItem > .content');

        $('.dropdownItem').map(function () {
            let el = $(this);
            if (el.children('.head').length > 0 && el.children('.content').length > 0) {

                el.children('.head').on('click', function (e) {
                    e.stopPropagation()
                    let el = $(this),
                        cont = el.siblings(dropContent),
                        parent = el.closest('.dropdownItem');

                    if (parent.hasClass('active')) {
                        cont.stop().slideUp(500, function () {
                            parent.removeClass('active');
                        });
                    } else {
                        cont.stop().slideDown(300);
                        parent.addClass('active');
                    }
                })
            }
        })
    }

    if ($('.cabWrapper select').length > 0) {
        $('.cabWrapper select').map(function () {
            var select = $(this)
            select.selectric({
                arrowButtonMarkup: '<span class="button"><img src="'+bundle+'/img/cab_select_arrow.svg" alt="arrow"></span>',
                labelBuilder: function (item) {
                    let icon = $(item.element).attr('data-icon');
                    return select.hasClass('payment') ? `<img src="${icon}" alt="icon" class="iconCur"> ${item.text}` : item.text;
                },
                optionsItemBuilder: function (item) {
                    let icon = $(item.element).attr('data-icon');
                    return select.hasClass('payment') ? `<img src="${icon}" alt="icon" class="iconCur"> ${item.text}` : item.text;
                },
            });
        })
    }

    if ($(".cabChartBlock").length > 0) {
        let dayData = JSON.parse($(".cabChartBlock").attr('data-day')),
            weekData = JSON.parse($(".cabChartBlock").attr('data-week')),
            monthData = JSON.parse($(".cabChartBlock").attr('data-month'));
        // const getData = (current = 'TRX', interval = '1d', grafic, series) => {
        //     fetch(`https://api.binance.com/api/v1/klines?symbol=${current}USDT&interval=${interval}`)
        //         .then((response) => {
        //             return response.json();
        //         })
        //         .then((data) => {
        //             myData = [];
        //             data = data.reverse();
        //             for (let i = 0; i < 10; i += 1) {
        //                 myData[i] = [];
        //                 myData[i][0] = data[i][0];
        //                 myData[i][1] = Number(data[i][2]);
        //             }
        //             series.data = myData;
        //             console.log('myData', series)
        //             setDataGraf(grafic, series);
        //         });
        // }

        let chartOptions = {
            chart: {
                borderColor: '#dfdfdf',
                backgroundColor: 'transparent',
                type: 'line',
                // height: '200',
                style: {
                    fontFamily: 'Alternox'
                },
                scrollablePlotArea: {
                    minWidth: 290,
                    scrollPositionX: 0,
                    opacity: 1
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: ''
                },
                lineColor: '#314656',
                gridLineColor: '#314656',
                minorGridLineColor: '#314656',
                minorGridLineWidth: 1,
                minorTickLength: 0,
                tickLength: 0,
                minorTickInterval: 1,
                labels: {
                    enabled: false,
                    style: {
                        color: '#8998a1',
                        fontSize: '9px',
                        letterSpacing: '0.02em'
                    },
                    rotation: 0
                },
                type: 'datetime',
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    style: {
                        color: '#8998a1',
                        fontSize: '9px',
                        letterSpacing: '0.02em'
                    }
                },
                lineColor: '#314656',
                lineWidth: 1,
                gridLineColor: '#314656',
                min: 0.055,
                tickInterval: 0.005,
            },
            tooltip: {
                useHTML: true,
                backgroundColor: 'transparent',
                borderColor: '#314656',
                borderWidth: 0,
                shadow: false,
                borderRadius: 0,
                formatter: function () {
                    return `<div class="chartTooltip">
            <span class="price">${this.point.y}$</span>
            </div>`
                }
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false,
                        fillColor: {

                            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                            stops: [
                                [0, '#e6d085'],
                                [1, '#fff6c5'],
                                [2, '#b49646'],
                            ]
                        },
                        // lineColor: '#db3c47',
                        lineWidth: 0,
                    },
                    fillOpacity: 1
                }
            },

            color: {
                linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                stops: [
                    [0, '#e6d085'],
                    [1, '#fff6c5'],
                    [2, '#b49646'],
                ]
            },
            legend: {
                enabled: false
            },
            series: [],
            credits: {
                enabled: false
            },
        }

        const setDataGraf = (grafic, data) => {
            let seriesLength = grafic.series.length;

            for (let i = seriesLength - 1; i > -1; i--) {
                grafic.series[i].remove();
            }

            let minArray = []
            for (let i = 0; i < data.data.length; i += 1) {
                minArray[i] = data.data[i][1]
            }

            grafic.update({
                yAxis: {
                    max: Math.max.apply(null, minArray),
                    min: Math.min.apply(null, minArray)
                },
            });

            grafic.addSeries({
                name: data.name,
                color: data.color,
                data: data.data,
            });

        }

        let graficCurrents = Highcharts.chart('cabChartBlock', chartOptions);
        let setData = (inerval) => {
            switch (inerval) {
                case '1M':
                    graficCurrents.update({
                        xAxis: {
                            tickInterval: 30 * 24 * 3600 * 1000,
                        },
                    });
                    setDataGraf(graficCurrents, {
                        lineWidth: 5,
                        color: {
                            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                            stops: [
                                [0, '#e6d085'],
                                [1, '#fff6c5'],
                                [2, '#b49646'],
                            ]
                        },
                        data: monthData
                    });
                    break;
                case '1w':
                    graficCurrents.update({
                        xAxis: {
                            tickInterval: 7 * 24 * 3600 * 1000,
                        },
                    });
                    setDataGraf(graficCurrents, {
                        lineWidth: 5,
                        color: {
                            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                            stops: [
                                [0, '#e6d085'],
                                [1, '#fff6c5'],
                                [2, '#b49646'],
                            ]
                        },
                        data: weekData
                    });
                    break;
                case '1d':
                    graficCurrents.update({
                        xAxis: {
                            tickInterval: 24 * 3600 * 1000,
                        },
                    });
                    setDataGraf(graficCurrents, {
                        lineWidth: 5,
                        color: {
                            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                            stops: [
                                [0, '#e6d085'],
                                [1, '#fff6c5'],
                                [2, '#b49646'],
                            ]
                        },
                        data: dayData
                    });
                    break;
                case '1h':
                    graficCurrents.update({
                        xAxis: {
                            tickInterval: 3600 * 1000,
                        },
                    });
                    break;
                default:
                    console.log('РѕС€РёР±РєР°')
            }
        }

        $('.chartOptions input').on('change', function (e) {
            setData(e.target.value);
        });

        setData($('.chartOptions input:checked').val())

        let chartScroll = $('.highcharts-scrolling')
        chartScroll.scrollLeft(chartScroll.width() * 2);
    }

    if ($('.cabBalanceTable').length > 0) {
        $('.cabBalanceTable').find('.head').on('click', function () {
            if ($(window).width() < 1150) {
                $(this).parent().toggleClass('active');
                $(this).siblings().slideToggle(300);
            } else {
                return false;
            }
        })
    }
})

window.onload = function (e) {
    if ($('body').length > 0) {
        $('body').addClass('loaded')
    }
}









const swipeToClose = function (e, start, func, direction) {
    const sensitivity = 100
    let end = e.changedTouches[0].clientX
    if (direction !== undefined && direction == 'toLeft') {
        if (start - end > sensitivity) {
            func()
        }
    } else {
        if (end - start > sensitivity) {
            func()
        }
    }
}

const clickOutToClose = function (e, menu, func) {
    if (!menu.contains(e.target)) {
        func()
    }
}

const clickEscToClose = function (e, func) {
    if (e.keyCode == 27) {
        func()
    }
}

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

const openMenu = (btn, content) => {
    if (!btn.hasClass('active')) {
        btn.addClass('active')
        content.addClass('active')
    }

    if (!$('body').hasClass('menuOpened')) {
        $('body').addClass('menuOpened')
        $('html, body').scrollTop(0)
    }
}
const closeMenu = (btn, content) => {
    btn.removeClass('active')
    content.removeClass('active')

    if ($('body').hasClass('menuOpened')) {
        $('body').removeClass('menuOpened')
    }
}

const addMenuEvents = (params) => {
    let btn = params.btn
    let content = params.content
    let event = params.event !== undefined ? params.event : 'click'
    let point = params.point !== undefined ? params.point : null
    let direction = params.closeDirection !== undefined ? params.closeDirection : 'toRight'
    let startTouch = 0

    function clearListeners() {
        if (event == 'click') {
            btn.off(event, openMenuHandler)
        }
        clearOffHandlers()
    }

    function clearOffHandlers() {
        $(document).off('keydown', closeMenuHandler)
        $(document).off('click', closeMenuHandler)
    }

    function closeMenuHandler(e) {
        if (e.type == 'keydown') {
            clickEscToClose(e, function () {
                closeMenu(btn, content)
                clearOffHandlers()
            })

        } else if (e.type == 'click') {
            clickOutToClose(e, content[0], function () {
                closeMenu(btn, content)
                clearOffHandlers()
            })
        } else if (e.type == 'mouseleave') {
            closeMenu(btn, content)
        } else if (e.type == 'touchstart') {
            if (btn.hasClass('active')) {
                startTouch = e.changedTouches[0].clientX
            }
        } else if (e.type == 'touchmove') {
            if (btn.hasClass('active')) {
                swipeToClose(e, startTouch, function () {
                    closeMenu(btn, content)
                    clearOffHandlers()
                }, direction)
            }
        }
    }

    function openMenuHandler(e) {
        if (e.type == 'click') {
            e.preventDefault()
            if (!btn.hasClass('active')) {
                openMenu(btn, content)
                setTimeout(function () {
                    $(document).on('keydown', closeMenuHandler)
                    $(document).on('click', closeMenuHandler)
                }, 100)
            } else {
                clearOffHandlers()
                closeMenu(btn, content)
            }
        } else if (e.type == 'mouseenter') {
            openMenu(btn, content)
        } else if (e.type == 'touchend') {
            openMenu(btn, content)
            setTimeout(function () {
                $(document).on('keydown', closeMenuHandler)
                $(document).on('click', closeMenuHandler)
            }, 100)
        }
    }

    function initMenu(e) {
        if (point !== null) {
            if ($(window).width() < point) {
                btn.on(event, openMenuHandler)
            }
        } else {
            if (event == 'mouse') {
                btn.on('mouseenter', openMenuHandler)
                btn.on('mouseleave', closeMenuHandler)
            } else if (event == 'touchend') {
                btn.on(event, openMenuHandler)
            } else {
                btn.on(event, openMenuHandler)
            }
        }
        window.addEventListener("touchstart", closeMenuHandler)
        window.addEventListener("touchmove", closeMenuHandler)
    }

    initMenu()

    $(window).on("resize", debounce(function (e) {
        if (point !== null) {
            clearListeners()
            initMenu(e)
        }
    }, 250))
}

const flyingDots = (canvasEl, event) => {
    let circles = [],
        canvas = canvasEl,
        context = canvas.getContext("2d"),
        opacity = 0.6,
        colors = ['#d3cba8', '#3cb1ff', '#b0975c'],
        minSize = 1,
        maxSize = 2,
        numCircles = 40,
        minSpeed = -4,
        maxSpeed = 4,
        expandState = false,
        isAnim = canvas.getAttribute('data-anim') !== undefined ? canvas.getAttribute('data-anim') : false;

    canvas.width = canvas.parentElement.clientWidth
    canvas.height = canvas.parentElement.clientHeight

    function buildArray() {
        'use strict';

        for (var i = 0; i < numCircles; i++) {
            var color = Math.floor(Math.random() * (colors.length - 1 + 1)) + 1,
                left = Math.floor(Math.random() * (canvas.width - 0 + 1)) + 0,
                top = Math.floor(Math.random() * (canvas.height - 0 + 1)) + 0,
                size = Math.floor(Math.random() * (maxSize - minSize + 1)) + minSize,
                leftSpeed = (Math.floor(Math.random() * (maxSpeed - minSpeed + 1)) + minSpeed) / 10,
                topSpeed = (Math.floor(Math.random() * (maxSpeed - minSpeed + 1)) + minSpeed) / 10,
                expandState = expandState;

            while (leftSpeed == 0 || topSpeed == 0) {
                leftSpeed = (Math.floor(Math.random() * (maxSpeed - minSpeed + 1)) + minSpeed) / 10,
                    topSpeed = (Math.floor(Math.random() * (maxSpeed - minSpeed + 1)) + minSpeed) / 10;
            }
            var circle = { color: color, left: left, top: top, size: size, leftSpeed: leftSpeed, topSpeed: topSpeed, expandState: expandState };
            circles.push(circle);
        }
    }

    function build() {
        for (var h = 0; h < circles.length; h++) {
            var curCircle = circles[h];
            context.fillStyle = colors[curCircle.color - 1];
            context.beginPath();
            if (curCircle.left > canvas.width + curCircle.size) {
                curCircle.left = 0 - curCircle.size;
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);
            } else if (curCircle.left < 0 - curCircle.size) {
                curCircle.left = canvas.width + curCircle.size;
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);
            } else {
                curCircle.left = curCircle.left + curCircle.leftSpeed;
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);
            }

            if (curCircle.top > canvas.height + curCircle.size) {
                curCircle.top = 0 - curCircle.size;
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);

            } else if (curCircle.top < 0 - curCircle.size) {
                curCircle.top = canvas.height + curCircle.size;
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);
            } else {
                curCircle.top = curCircle.top + curCircle.topSpeed;
                if (curCircle.size != maxSize && curCircle.size != minSize && curCircle.expandState == false) {
                    curCircle.size = curCircle.size - 0.1;
                }
                else if (curCircle.size != maxSize && curCircle.size != minSize && curCircle.expandState == true) {
                    curCircle.size = curCircle.size + 0.1;
                }
                else if (curCircle.size == maxSize && curCircle.expandState == true) {
                    curCircle.expandState = false;
                    curCircle.size = curCircle.size - 0.1;
                }
                else if (curCircle.size == minSize && curCircle.expandState == false) {
                    curCircle.expandState = true;
                    curCircle.size = curCircle.size + 0.1;
                }
                context.arc(curCircle.left, curCircle.top, curCircle.size, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fill();
            context.ellipse;
        }
    }

    var xVal = 0

    window.requestAnimFrame = (function (callback) {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })()

    function animate() {
        var canvas = canvasEl,
            context = canvas.getContext("2d");
        context.clearRect(0, 0, canvas.width, canvas.height)
        xVal++;
        build()
        if (isAnim) {
            requestAnimFrame(function () {
                animate()
            })
        }
    }

    if (event == 'build') {
        buildArray()
        animate()
    } else if (event == 'resize') {
        // buildArray()
        animate()
    }
}