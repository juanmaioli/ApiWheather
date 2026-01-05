<?php
include("config.php");
include("funciones.php");

// --- Fetch data from OpenWeatherMap API ---
// Use variables from config.php ($ciudad, $apiKey)
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&units=metric&lang=es&appid=" . $apiKey;
$responseJson = @file_get_contents($apiUrl); // Use @ to suppress warnings on failure

if ($responseJson === false) {
    die("Error: No se pudo conectar a la API de OpenWeatherMap.");
}

$data = json_decode($responseJson);

if ($data === null || isset($data->cod) && $data->cod != 200) {
    die("Error: Respuesta inválida de la API. Mensaje: " . ($data->message ?? 'No hay datos'));
}

// --- Process API data ---
// Use $zonaHoraria from config.php
$fecha = new DateTime('now', new DateTimeZone('UTC'));
$fecha->modify($zonaHoraria);
$fechaFormateada = $fecha->format('Y-m-d H:i:s');

$report_dt = new DateTime('@' . $data->dt);
$report_dt->setTimezone(new DateTimeZone(str_replace(' hours', '', $zonaHoraria))); // Parse timezone string loosely or use explicit timezone if available
$report_dt->modify($zonaHoraria); // Apply offset if timezone object isn't perfect from string
$report_dt_formateada = $report_dt->format('Y-m-d H:i');


$ciudadNombre = $data->name;
$temp = $data->main->temp;
$presion = $data->main->pressure;
$humedad = $data->main->humidity;
$vel_viento_ms = $data->wind->speed;
$vel_dir_deg = $data->wind->deg ?? 0;
$nubes = $data->clouds->all;
$descripcion = $data->weather[0]->description;
$icono = $data->weather[0]->icon . ".png";
$temp_st = $data->main->feels_like;
$visibilidad = isset($data->visibility) ? $data->visibility / 1000 : 0; // Visibility in km

// Convert wind speed from m/s to km/h
$vel_viento_kmh = round($vel_viento_ms * 3.6);
$vel_dir_cardinal = wind_cardinals($vel_dir_deg);

// --- Database connection ---
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// --- Insert data using Prepared Statements (Security Fix) ---
$sql = "INSERT INTO " . $dbTable . " (
    w_report,
    w_date,
    w_temp,
    w_humedad,
    w_wind,
    w_dir,
    w_pressure,
    w_desc,
    w_icon,
    w_visibility,
    w_city,
    w_cloud,
    w_temp_st
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Bind parameters: s=string, d=double, i=integer
$stmt->bind_param(
    "ssddisdsdsidi",
    $report_dt_formateada,
    $fechaFormateada,
    $temp,
    $humedad,
    $vel_viento_kmh,
    $vel_dir_cardinal,
    $presion,
    $descripcion,
    $icono,
    $visibilidad,
    $ciudadNombre,
    $nubes,
    $temp_st
);

// Execute the statement
if ($stmt->execute()) {
    echo "Nuevo registro de clima insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
