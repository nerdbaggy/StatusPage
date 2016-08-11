$( document ).ready(function() {
    var pageInfo = [];
    var template =  StatusPage.templates.table;
    var resultsPlaceholder = $("#target");
    var logsModal = StatusPage.templates.logs;
    var timerRunning = false;
    var firstRun = true;
    var counter = null;

    var latencyModal = $('#latencyModal');
    var countdownText = $('#countdownText');
    var timerText = null;

    // config stuff
    $("#statusPageName").text(config.websiteName);
    if (!config.showFooter) {
        $("#footer").hide();
    }

    if (config.alertEnabled){
        $("#alertBar").addClass('alert alert-' + config.alertColor).html(config.alertMessage );
    }

    addContent();

    function addContent(data) {
        var req = $.ajax({
            type: 'GET',
            url: config.backendURL,
            jsonpCallback: 'StatusPage',
            contentType: "application/json",
            dataType: 'jsonp',
            data: data,
            timeout: 7000,
            error: (function(e) {
                resultsPlaceholder.html('<h4>An error has occurred</h4>  <i class="fa fa-frown-o fa-3x"></i>');
            }),
            success: function(json) {
                var allChecks = [];
                $.each(json.checks || [], function(item, obj) {
                    allChecks.push(prettifyCode(obj));
                });

                if (config.desiredOrder) {
                    allChecks.sort(function(a,b) {
                        return config.desiredOrder[a.id] > config.desiredOrder[b.id] ? 1 : -1;
                    });
                }

                pageInfo = {
                    checks: allChecks,
                    headers: json.headers
                };
               

                if (!timerRunning) {
                    resultsPlaceholder.html(template(pageInfo));
                    $(".fa-bars").click(function() {
                        $("#LogDisplayTitle").text(pageInfo['checks'][$(this).data('cid')]['name'] + ' Check');
                        $("#logsArea").html(logsModal(pageInfo['checks'][$(this).data('cid')]['log']));
                        $('#logsDisplay').modal('show');

                    });

                    countdownText.html('Next update in <span id="timer"></span> seconds');
                    timerText = $("#timer");
                    timerText.text(config.updateInterval);
                    count = config.updateInterval;
                    counter = setInterval(timer, 1000);
                    timerRunning = true;
                    if (pageInfo['checks'][0]['log'].length === 0) {
                        addContent('action=update');
                    }
                }
            }
        });
    }

    function prettifyCode(check) {
        //Make status look good
        switch (parseInt(check.status, 10)) {
            case 0:
                check.status = {
                    status: 'Paused',
                    icon: 'pause',
                    color: 'muted'
                };
                break;
            case 1:
                check.status = {
                    status: 'Pending',
                    icon: 'pause',
                    color: 'muted'
                };
                break;
            case 2:
                check.status = {
                    status: 'Online',
                    icon: 'arrow-up',
                    color: 'success'
                };
                break;
            case 8:
                check.status = {
                    status: 'Seems Offline',
                    icon: 'arrow-down',
                    color: 'warning'
                };
                break;
            case 9:
                check.status = {
                    status: 'Offline',
                    icon: 'arrow-down',
                    color: 'danger'
                };
                break;
        }

        switch (parseInt(check.type, 10)) {
            case 1:
                check.type = 'HTTP(S)';
                break;
            case 2:
                check.type = 'Keyword';
                break;
            case 3:
                check.type = 'Ping';
                break;
            case 4:
                check.type = 'Port';
                break;
        }

        check.allUpTime = {
            percent: check.allUpTimeRatio,
            color: getColorToPercent(check.allUpTimeRatio)
        };

        var customUptime = [];
        $.each(check.customUptimeRatio || [], function(key, percent) {
            customUptime.push({
                percent: percent,
                color: getColorToPercent(percent)
            });
        });

        check.customuptime = customUptime;

        var log = [];

        $.each(check.log || [], function(index, events) {
            var timeDiff = null;
            if (index === 0) {
                var diffSeconds = (check.currentTime - events.datetime );
                var diffHours = Math.floor(diffSeconds / 3600);
                var diffMinutes = Math.floor((diffSeconds % 3600) / 60);
                timeDiff = diffHours + ' hours, ' + diffMinutes + ' Mins';
            } else {
                var diffSeconds = check.log[index - 1]['dateMs'] - events.datetime;
                var diffHours = Math.floor(diffSeconds / 3600);
                var diffMinutes = Math.floor((diffSeconds % 3600) / 60);
                timeDiff = diffHours + ' hours, ' + diffMinutes + ' Mins';
            }
            switch (parseInt(events.type, 10)) {
                case 1:
                    log.push({
                        status: 'Offline',
                        icon: 'arrow-down',
                        color: 'danger',
                        dateMs: events.datetime,
                        duration: timeDiff,
                        date: events.actualTime
                    });
                    break;
                case 2:
                    log.push({
                        status: 'Online',
                        icon: 'arrow-up',
                        color: 'success',
                        dateMs: events.datetime,
                        duration: timeDiff,
                        date: events.actualTime
                    });
                    break;
                case 99:
                    log.push({
                        status: 'Paused',
                        icon: 'pause',
                        color: 'primary',
                        dateMs: events.datetime,
                        duration: timeDiff,
                        date: events.actualTime

                    });
                    break;
                case 98:
                    log.push({
                        status: 'Started',
                        icon: 'play',
                        color: 'primary',
                        dateMs: events.datetime,
                        duration: timeDiff,
                        date: events.actualTime
                    });
                    break;
            }
            check.log = log;
        });

        //Delete the bad things
        delete check.allUpTimeRatio;
        delete check.customUptimeRatio;
        return check;

    }

    function getColorToPercent(percent) {
        if (percent >= config.percentGreen) {
            return 'success';
        } else if (percent >= config.percentYellow) {
            return 'warning';
        } else {
            return 'danger';
        }
    }

    latencyModal.on('show.bs.modal', function(e) {
        $("#latencyTitle").text(pageInfo['checks'][$(e.relatedTarget).data('cid')]['name'] + ' Check');
    });

    latencyModal.on('shown.bs.modal', function(e) {
        if (pageInfo['checks'][$(e.relatedTarget).data('cid')]['responseTime'].length > 0){
        new Morris.Line({
            element: 'latencyChart',
            data: pageInfo['checks'][$(e.relatedTarget).data('cid')]['responseTime'],
            xkey: 'datetime',
/*            lineColors: ['#108eee'],
            pointFillColors: ['#0b62a4'],*/
            ykeys: ['value'],
            labels: ['Latency'],
            xLabels: '30min',
            ymax: 'auto',
            yLabelFormat: function(y) {
                return y.toString() + ' ms';
            },
            hoverCallback: function (index, options, content, row) {
  return '<div class="morris-hover-point" style="color: #0b62a4">'+row.value +'ms</div>';
}
        });

    } else {
        $("#latencyChart").html('<h4 class="text-center">No graphing data is currently available, sorry!</h4>')
    }
    });

    latencyModal.on('hidden.bs.modal', function(e) {
        $("#latencyChart").empty();
    });

    function timer() {
        count = count - 1;
        if (count <= 0)
        {
            clearInterval(counter);
            timerRunning = false;
            addContent('action=update');
            countdownText.html('Updating <i class="fa fa-refresh fa-spin"></i>');
            return;
        }

        timerText.text(count);
    }


});
