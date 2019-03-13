let canvasCtnr = document.getElementById("canvasCtnr");
let canvas = document.createElement("canvas");
const GRAPH_W = 470;
const GRAPH_H = 300;
const ACTIVE_W = GRAPH_W - 20;
const ACTIVE_H = GRAPH_H - 20;
canvasCtnr.appendChild(canvas);
canvas.width = GRAPH_W;
canvas.height = GRAPH_H;
let ctx = canvas.getContext("2d");

function updateGraph() {
  let dotSize = 2;
  ctx.fillStyle = "#eee";
  ctx.fillRect(0,0,GRAPH_W,GRAPH_H);

  let measuresCount = measuresData.measures.length;
  let xUnit = ACTIVE_W / (measuresCount-1);
  let tempRange = measuresData.maxTemp - measuresData.minTemp;
  let yTempUnit = ACTIVE_H / tempRange;
  let yHumUnit = (ACTIVE_H / (measuresData.maxHum - measuresData.minHum));

  ctx.beginPath();
  for (let i = 0; i < measuresCount; i++) {
    ctx.fillStyle = "#f00";
    ctx.strokeStyle = "#f00";
    let relTemp = measuresData.measures[i].temperature - measuresData.minTemp;
    //let nextRelTemp = (measuresData.measures[i-1]) ? measuresData.measures[i-1].temperature - measuresData.minTemp : relTemp;
    let y = (ACTIVE_H - (relTemp * yTempUnit) - dotSize) + 10;
    let x = i * xUnit + dotSize;
    // let nextX = (i - 1) * xUnit + dotSize;
    // let nextY = ((ACTIVE_H - (nextRelTemp * yTempUnit) - dotSize) + 10);
    // let px = ((nextX - x) / 2) + x;
    // let py = ((nextY - y) / 2) + y;
    //ctx.fillRect(px, py, 4,4);
    //ctx.quadraticCurveTo(px, py, x, y);
    ctx.lineTo(x, y);
    ctx.stroke();
    //ctx.fillRect(x, y, dotSize,dotSize);
    ctx.fillText(measuresData.measures[i].temperature + "°C", x+5,y+5);
    ctx.beginPath();
    ctx.ellipse(x, y, dotSize, dotSize,0, 0, 2 * Math.PI);
    ctx.fill();
    ctx.closePath();
  }

  ctx.closePath();

  ctx.beginPath();

  for (let i = 0; i < measuresCount; i++) {
    ctx.fillStyle = "#00f";
    ctx.strokeStyle = "#00f";
    let relHum = measuresData.measures[i].humidity - measuresData.minHum;
    let y = (ACTIVE_H - (relHum * yHumUnit) - dotSize) + 10;
    let x = i * xUnit + dotSize;
    ctx.lineTo(x,y);
    ctx.stroke();

    ctx.fillText(measuresData.measures[i].humidity + "%", x+5,y+5);
    ctx.beginPath();
    ctx.ellipse(x, y, dotSize, dotSize,0, 0, 2 * Math.PI);
    ctx.fill();
    ctx.closePath();
  }
  ctx.closePath();

  console.log("update graph");
  console.log("xunit :" + xUnit);
  console.log("count: " + measuresCount);
  console.log("min:" + measuresData.minTemp);
  console.log("max:" + measuresData.maxTemp);
  //console.log("test index :" + measuresData.measures[2].temperature);
}
