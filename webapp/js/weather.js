var URI = "http://api.openweathermap.org/data/2.5/weather?q=saida&appid=12e0fd7411bee027a6e76d9387843db9&units=metric";
$.get(URI, function(response) {
    /**
     * {
        "coord":{
            "lon":0.15,
            "lat":34.84
        },
        "weather":[
            {
                "id":800,
                "main":"Clear",
                "description":"clear sky",
                "icon":"01d"
            }
        ],
        "base":"stations",
        "main":{
            "temp":12,
            "pressure":1028,
            "humidity":54,
            "temp_min":12,
            "temp_max":12
        },
        "visibility":10000,
        "wind":{
            "speed":2.1,
            "deg":180
        },
        "clouds":{
            "all":0
        },
        "dt":1514192400,
        "sys":{
            "type":1,
            "id":6217,
            "message":0.0031,
            "country":"DZ",
            "sunrise":1514185503,
            "sunset":1514220870
        },
        "id":2482572,
        "name":"Saida",
        "cod":200
        }
     */
    $("#owTemp").html(response.main.temp);
    $("#owHumidity").html(response.main.humidity + " %");
    $("#owPressure").html(response.main.pressure);
    $("#owWindSpeed").html(response.wind.speed + "Km/H");
    $("#owWindDegree").html(response.wind.deg);
});