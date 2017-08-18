$(document).ready(function () {
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });
    var data = [];
    setInterval(function () {
        $.get("/pi/api/dht11", function (response) {
            var receivedData = response.data;
            for (var i = 0; i < receivedData.length; i++) {
                var timestamp = moment(receivedData[i].instant, "YYYY-MM-DD h:mm:ss").toDate().getTime();
                var temperature = parseFloat(receivedData[i].temp);
                data.push({
                    x: timestamp,
                    y: temperature
                });
            }
            showGraphic();
        });
    }, 1000);
    function showGraphic() {
        Highcharts.chart('container', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10
            },
            title: {
                text: 'DHT11 real time visualization'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: data
            }]
        });
    }
});