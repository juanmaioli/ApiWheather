<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

include("config.php");
include("funciones.php");

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
// Add any other variables that might not be set
$w_prpInt = 0;

// --- Get sunrise and sunset times ---
$sun_info = date_sun_info(time(), $latitudActual, $longitudActual);
$amanecer = gmdate('H:i', $sun_info['sunrise'] + 3600 * ($timezone));
$atardecer = gmdate('H:i', $sun_info['sunset'] + 3600 * ($timezone));

// --- Database connection ---
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // In a real app, you might want to log this error instead of just dying
    die(json_encode(["error" => "Error de conexión a la base de datos: " . $conn->connect_error]));
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
    $w_prpInt      = $row["w_prpInt"] ?? 0;
}
$conn->close();

// --- Post-process data for display ---
$temp_display = $w_tempMostrar . "&deg;C";
$st_display = $w_temp_st . "&deg;C";

if ($w_temp_st == $w_tempMostrar) {
    // If temp and feels_like are the same, don't show feels_like
    $st_display = "-";
}

$w_iconGrande = iconoClimaEmoji($w_icon);

// --- Build the output array ---
$output_data = [
    ['etiqueta'=>'Ciudad','icon' => '📍', 'dato' => $w_city],
    ['etiqueta'=>'Estado','icon' => $w_iconGrande, 'dato' => 'Icono'], // 'Icono' is not very descriptive, but keeping it
    ['etiqueta'=>'Descripción','icon' => '📝', 'dato' => $w_desc],
    ['etiqueta'=>'Temperatura','icon' => '🌡️', 'dato' => $temp_display],
    ['etiqueta'=>'Sensación Térmica','icon' => '🤔🌡️', 'dato' => $st_display],
    ['etiqueta'=>'Humedad','icon' => '💦', 'dato' => $w_humedadMostrar . ' %H'],
    ['etiqueta'=>'Presión','icon' => '📈', 'dato' => $w_pressure . 'hpa'],
    ['etiqueta'=>'Viento','icon' => '🌬️', 'dato' => 'del ' . $w_dir],
    ['etiqueta'=>'Velocidad del Viento','icon' => '💨', 'dato' => $w_wind . 'km/h'],
    ['etiqueta'=>'Porcentaje de Nubes','icon' => '☁️', 'dato' => $w_cloud . '%'],
    ['etiqueta'=>'Visibilidad','icon' => '🔭', 'dato' => $w_visibility . 'km'],
    ['etiqueta'=>'Amanecer','icon' => '🌇', 'dato' => $amanecer],
    ['etiqueta'=>'Atardecer','icon' => '🌃', 'dato' => $atardecer],
    ['etiqueta'=>'Fecha del reporte','icon' => '🗓️', 'dato' => $w_reportm]
];

// --- Echo the final JSON output ---
// The JSON_UNESCAPED_UNICODE flag ensures emojis are encoded correctly.
echo json_encode($output_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>



