window.onload = function () {

    let points = [];
    let humPoints = [];

    for (let i=0; i<dates.length; i++) {
        let str = dates[i];
        str = str.replace("le ", "");
        str = str.replace(" à ", " ");
        let dateX = new Date(str);
        points.push({"x": dateX, "y":parseInt(temperatures[i])});
        humPoints.push({"x": dateX, "y":parseInt(humidities[i])});
    }

    let chart = new CanvasJS.Chart("chartGraph", {
        animationEnabled: true,
        title:{
            text: "NodeMCU DHT11 measures"
        },
        axisX: {
            valueFormatString: "le DD-MM-YYYY à HH:mm:ss"
        },
        axisY: {
            title: "Temperature / humidity",
            includeZero: false,
        },
        legend:{
            cursor: "pointer",
            fontSize: 16,
            itemclick: toggleDataSeries
        },
        toolTip:{
            shared: true
        },
        data: [{
            name: "Temperature",
            type: "spline",
            yValueFormatString: "## °C",
            showInLegend: true,
            dataPoints: points
        },
        {
            name: "Humidity",
            type: "spline",
            yValueFormatString: "##,## %",
            showInLegend: true,
            dataPoints: humPoints  
        }]
    });

    chart.render();

    function toggleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }

}