<?php
include("../config.php");
include("../funciones.php");

$fecha = date('Y-m-d H:i:s');
$date = new DateTime($fecha);
$date->modify($zonaHoraria);
$nuevoAnio = $date->format('Y');
$nuevoMes =  $date->format('m');
"";

$timezone  = -3;
$latitudActual = -38.94276;
$longitudActual = -68.053724;
$data = date_sun_info(time(), $latitudActual, $longitudActual);

$amanecer = gmdate("H:i", $data['sunrise'] + 3600 * ($timezone));
$atardecer = gmdate("H:i", $data['sunset'] + 3600 * ($timezone));

//DatosWidget
$sql = "SELECT * FROM cava_weather2 order by w_report desc limit 1";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$w_id          = $row["w_id"];
	$w_reportm     = substr($row["w_report"], 0, -3);
	$w_tempMostrar = round($row["w_temp"], 1);
	$w_temp_st     = round($row["w_temp_st"], 1);
	$w_temp        = $w_tempMostrar;
	$w_humedadMostrar = intval($row["w_humedad"]);
	$w_humedad     = $w_humedadMostrar;
	$w_wind        = round($row["w_wind"],0);
	$w_dir         = $row["w_dir"];
	$w_pressure    = round($row["w_pressure"], 0);
	$w_desc        = ucwords($row["w_desc"]);
	$w_icon        = $row["w_icon"];
	$w_visibility  = $row["w_visibility"];
	$w_city        = $row["w_city"];
	$w_cloud       = $row["w_cloud"];
	$w_rafagas     = $row["w_rafagas"];
	$w_prpInt			 = $row["w_prpInt"];
	$w_prpprop     = $row["w_prpprop"];
	$w_puntorocio  = $row["w_puntorocio"];
	$w_uvindex     = $row["w_uvindex"];
	$w_ozono       = $row["w_ozono"];
}

if ($w_prpInt == 0) {
	$w_prpInt = "";
}

if ($w_temp_st != $w_tempMostrar) {
	$w_tempMostrar = $w_tempMostrar . "&deg;C";
	$w_temp_st = $w_temp_st . "&deg;C";
} else {
	$w_tempMostrar = $w_tempMostrar . "&deg;C - ";
}

$conn->close();

$w_iconGrande = iconoClimaEmoji($w_icon);

?>

<div class='emoji-container'><span class='emoji'><?php echo $w_iconGrande; ?></span></div><br>
📍 <?php echo $w_city; ?><br>
📝 <?php echo $w_desc; ?><br>
🌡️ <?php echo $w_tempMostrar; ?><br>
🤔🌡️ <?php echo $w_temp_st; ?><br>
💦 <?php echo $w_humedadMostrar; ?> %H<br>
📈 <?php echo $w_pressure; ?>hpa<br>
🌬️ del <?php echo $w_dir; ?><br>
💨 <?php echo $w_wind; ?>km/h<br>
☁️ <?php echo $w_cloud; ?>%<br>
🔭 <?php echo $w_visibility; ?>km<br>
🌇 <?php echo $amanecer; ?><br>
🌃 <?php echo $atardecer; ?><br>
🗓️ <?php echo $w_reportm; ?><br>