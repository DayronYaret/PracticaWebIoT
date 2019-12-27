window.onload = function () {var chart1 = new CanvasJS.Chart("chartContainer1", {
    animationEnabled: true,
    title:{
        text: "Canal de Manolo"
    },
    axisY: {
        title: "Valor eje Y",
    },
    data: [{
        type: "spline",
        markerSize: 5,
        xValueFormatString: "H:mm:s",
        yValueFormatString: "#,##0.##",
        xValueType: "dateTime",
        dataPoints: <br/>
    <b>Notice</b>:  Undefined variable: dataPoints in <b>C:\laragon\www\practica\principal.php</b> on line <b>78</b><br />
    null}]
});

    chart1.render();var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title:{
            text: "Teleco"
        },
        axisY: {
            title: "Valor eje Y",
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "H:mm:s",
            yValueFormatString: "#,##0.##",
            xValueType: "dateTime",
            dataPoints: [{"x":1572442167000,"y":12},{"x":1572442390000,"y":-61},{"x":1572442395000,"y":-62},{"x":1572442401000,"y":-60},{"x":1572442406000,"y":-57},{"x":1572442411000,"y":-59},{"x":1572442416000,"y":-55},{"x":1572442421000,"y":-55},{"x":1572442427000,"y":-60},{"x":1572442432000,"y":-63},{"x":1572442437000,"y":-63},{"x":1572442442000,"y":-67},{"x":1572442447000,"y":-64},{"x":1572442452000,"y":-60},{"x":1572442458000,"y":-64},{"x":1572442463000,"y":-62},{"x":1572442468000,"y":-61},{"x":1572442473000,"y":-61},{"x":1572442479000,"y":-61},{"x":1572442484000,"y":-65},{"x":1572442489000,"y":-62},{"x":1572442494000,"y":-56},{"x":1572442500000,"y":-53}]}]
    });

    chart2.render();}