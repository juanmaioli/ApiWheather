
function gaugeDraw(id,data) {

  var color1 = "#000";
  var color2 = "#000";
  var X = 120;
  var Y = 120;
  var outterRadius = 100;
  var innerRadius = 55;
  var c = document.getElementById(id);
  var context = c.getContext("2d");
  context.clearRect(0, 0, 400, 240);
  context.fillStyle = "#000";
  context.font = "25px Arial";
  context.textAlign = "center";
  context.fillText(data + " " + String.fromCharCode(176) + "C",120,125);
  context.font = "10px Arial";


  context.fillText("-50",40,115);
  context.fillText("50",200,115);

  if ( -50 < data && data <= 0) {color1 = "#343A40"; color2 = "#343A40";}
  if ( 0 < data && data <= 10 ) {color1 = "#007BFF"; color2 = "#007BFF";}
  if ( 10 < data && data <= 25) {color1 = "#28A745"; color2 = "#28A745";}
  if ( 25 <= data && data <= 30) {color1 = "#FFC107"; color2 = "#FFC107";}
  if ( 30 <= data && data <= 50) {color1 = "#DC3545"; color2 = "#DC3545";}

  var dataScale = ((50 + data) * 0.008)+1.1;

  //Measure
  setRadialGradient(color1, color2);
  drawDonut(Math.PI * 1.1, Math.PI * dataScale);

  //Grey Background
  setRadialGradient("#EEE", "#EEE");
  drawDonut(Math.PI * dataScale, Math.PI * 1.9);

  function drawDonut(sRadian, eRadian){
      context.beginPath();
      context.arc(X, Y, outterRadius, sRadian, eRadian, false); // Outer: CCW
      context.arc(X, Y, innerRadius, eRadian, sRadian, true); // Inner: CW
      context.closePath();
      context.shadowColor = "#777";
      context.shadowBlur = 1;
      context.shadowOffsetX = 0;
      context.shadowOffsetY = 0;
      context.fill();
  }

  function setRadialGradient(sgc, bgc){
      var grd = context.createRadialGradient(X, Y, innerRadius + 5, X, Y, outterRadius);
      grd.addColorStop(0,sgc);
      grd.addColorStop(1,bgc);
      context.fillStyle = grd;
  }
}

function gaugeDraw2(id,data) {

  var color1 = "#000";
  var color2 = "#000";
  var X = 120;
  var Y = 120;
  var outterRadius = 100;
  var innerRadius = 55;
  var c = document.getElementById(id);
  var context = c.getContext("2d");
  context.clearRect(0, 0, 400, 240);
  context.fillStyle = "#000";
  context.font = "25px Arial";
  context.textAlign = "center";
  context.fillText(data + " " + String.fromCharCode(176) + "C",120,125);
  context.font = "10px Arial";
  context.fillText("0",40,115);
  context.fillText("100",200,115);

  if ( -50 < data && data <= 0) {color1 = "#343A40"; color2 = "#343A40";}
  if ( 0 < data && data <= 25 ) {color1 = "#007BFF"; color2 = "#007BFF";}
  if ( 25 < data && data <= 50) {color1 = "#28A745"; color2 = "#28A745";}
  if ( 50 <= data && data <= 75) {color1 = "#FFC107"; color2 = "#FFC107";}
  if ( 75 <= data && data <= 100) {color1 = "#DC3545"; color2 = "#DC3545";}

  var dataScale = ((0 + data) * 0.008)+1.1;

  //Measure
  setRadialGradient(color1, color2);
  drawDonut(Math.PI * 1.1, Math.PI * dataScale);

  //Grey Background
  setRadialGradient("#EEE", "#EEE");
  drawDonut(Math.PI * dataScale, Math.PI * 1.9);

  function drawDonut(sRadian, eRadian){
      context.beginPath();
      context.arc(X, Y, outterRadius, sRadian, eRadian, false); // Outer: CCW
      context.arc(X, Y, innerRadius, eRadian, sRadian, true); // Inner: CW
      context.closePath();
      context.shadowColor = "#777";
      context.shadowBlur = 1;
      context.shadowOffsetX = 0;
      context.shadowOffsetY = 0;
      context.fill();
  }

  function setRadialGradient(sgc, bgc){
      var grd = context.createRadialGradient(X, Y, innerRadius + 5, X, Y, outterRadius);
      grd.addColorStop(0,sgc);
      grd.addColorStop(1,bgc);
      context.fillStyle = grd;
  }
}
