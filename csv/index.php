<?php
include("../config.php");
include("../funciones.php");

// --- Initialize variables with default values ---
$w_reportm = '';
$w_tempMostrar = 0;
$w_temp_st = 0;
$w_humedadMostrar = 0;
$w_wind = 0;
$w_dir = '';
$w_pressure = 0;
$w_desc = 'No disponible';
$w_icon = '';
$w_visibility = 0;
$w_city = 'No disponible';
$w_cloud = 0;

// --- Get sunrise and sunset times ---
$sun_info = date_sun_info(time(), $latitudActual, $longitudActual);
$amanecer = gmdate("H:i", $sun_info['sunrise'] + 3600 * ($timezone));
$atardecer = gmdate("H:i", $sun_info['sunset'] + 3600 * ($timezone));

// --- Database connection ---
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // For this simple text output, we can just show an error message.
    die("Error de conexión.");
}
$conn->set_charset("utf8");

// --- Fetch latest weather data ---
$sql = "SELECT * FROM " . $dbTable . " ORDER BY w_report DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    // If we have a result, overwrite the default values
    $w_reportm     = substr($row["w_report"], 0, -3);
    $w_tempMostrar = round($row["w_temp"], 1);
    $w_temp_st     = round($row["w_temp_st"], 1);
    $w_humedadMostrar = intval($row["w_humedad"]);
    $w_wind        = round($row["w_wind"], 0);
    $w_dir         = $row["w_dir"];
    $w_pressure    = round($row["w_pressure"], 0);
    $w_desc        = ucwords($row["w_desc"]);
    $w_icon        = $row["w_icon"];
    $w_visibility  = $row["w_visibility"] ?? 0;
    $w_city        = $row["w_city"];
    $w_cloud       = $row["w_cloud"] ?? 0;
}
$conn->close();

// --- Post-process data for display ---
$temp_display_str = $w_tempMostrar . "&deg;C";
$st_display_str = $w_temp_st . "&deg;C";

// Original logic had a slight bug showing 'X&deg;C - ' when equal
if ($w_temp_st != $w_tempMostrar) {
    // Values are different, show both
} else {
    // Values are the same, make 'feels like' temperature empty
    $st_display_str = "-";
}

$w_iconGrande = iconoClimaEmoji($w_icon);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clima</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; }
        .emoji-container { text-align: center; font-size: 4em; }
    </style>
</head>
<body>

<div class='emoji-container'><span class='emoji'><?php echo htmlspecialchars($w_iconGrande); ?></span></div><br>
📍 <?php echo htmlspecialchars($w_city); ?><br>
📝 <?php echo htmlspecialchars($w_desc); ?><br>
🌡️ <?php echo $temp_display_str; // HTML is already in the string, no need to escape ?><br>
🤔🌡️ <?php echo $st_display_str; // HTML is already in the string, no need to escape ?><br>
💦 <?php echo htmlspecialchars($w_humedadMostrar); ?> %H<br>
📈 <?php echo htmlspecialchars($w_pressure); ?>hpa<br>
🌬️ del <?php echo htmlspecialchars($w_dir); ?><br>
💨 <?php echo htmlspecialchars($w_wind); ?>km/h<br>
☁️ <?php echo htmlspecialchars($w_cloud); ?>%<br>
🔭 <?php echo htmlspecialchars($w_visibility); ?>km<br>
🌇 <?php echo htmlspecialchars($amanecer); ?><br>
🌃 <?php echo htmlspecialchars($atardecer); ?><br>
🗓️ <?php echo htmlspecialchars($w_reportm); ?><br>

</body>
</html>
