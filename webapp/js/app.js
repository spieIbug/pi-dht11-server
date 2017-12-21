window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

window.randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
};

var dates = [];
var temperatures = [];
var humiditys = [];
var limit = 50;

function updateLimit() {
    limit = document.getElementById("limit").value;
}

function updateData(response) {
    dates = [];
    temperatures = [];
    humiditys = [];
    for (var i = 0; i < response.data.length; i++) {
        dates.push(response.data[i].instant);
        temperatures.push(response.data[i].temp);
        humiditys.push(response.data[i].humidity);
    }
}

$.get("/pi/api/dht11/" + limit, updateData);
var config = {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: "Temperature",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: temperatures,
            fill: false,
        }, {
            label: "Humidity",
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: humiditys,
        }]
    },
    options: {
        responsive: true,
        title:{
            display:true,
            text:'DHT11 real time visualization'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'time'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};
window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
    setInterval(function(){
        $.get("/pi/api/dht11/" + limit, updateData);
        config.data.labels = dates;
        config.data.datasets.forEach(function(dataset) {
            if (dataset.label==="Temperature") {
                dataset.data = temperatures;
            } else {
                dataset.data = humiditys;
            }
        });
        window.myLine.update();
    }, 1000).bind(limit);
};