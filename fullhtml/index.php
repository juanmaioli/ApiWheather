<?php
include("../config.php");
include("../funciones.php");

$fecha = date('Y-m-d H:i:s');
$date = new DateTime($fecha);
$date->modify($zonaHoraria);
$nuevoAnio = $date->format('Y');
$nuevoMes =  $date->format('m');
$nuevoDia =  $date->format('d');
$datepicker1 = "";

// $timezone, $latitudActual, $longitudActual come from config.php
$data = date_sun_info(time(), $latitudActual, $longitudActual);

$amanecer = gmdate("H:i", $data['sunrise'] + 3600 * ($timezone));
$atardecer = gmdate("H:i", $data['sunset'] + 3600 * ($timezone));

//DatosWidget
$sql = "SELECT * FROM " . $dbTable . " order by w_report desc limit 1";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$w_id          = $row["w_id"];
	$w_reportm     = $row["w_report"];
	$w_tempMostrar = round($row["w_temp"], 1);
	$w_temp_st     = round($row["w_temp_st"], 1);
	$w_temp        = $w_tempMostrar;
	$w_humedadMostrar = intval($row["w_humedad"]);
	$w_humedad     = $w_humedadMostrar;
	$w_wind        = $row["w_wind"];
	$w_dir         = $row["w_dir"];
	$w_pressure    = $row["w_pressure"];
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

if ($w_uvindex == 0) {
	$w_uvindex  = "<td class='bg-primary text-right text-white rounded'>" . $w_uvindex . "</td>";
} else {
	switch ($w_uvindex) {
		case $w_uvindex <= 2;
			$w_uvindex  = "<td class='bg-success text-right text-white rounded'>" . $w_uvindex . "</td>";
			break;
		case $w_uvindex >= 3 and $w_uvindex <= 5;
			$w_uvindex  = "<td class='bg-warning text-right text-white rounded'>" . $w_uvindex . "</td>";
			break;
		case $w_uvindex >= 6 and $w_uvindex <= 7;
			$w_uvindex  = "<td class='text-right text-white rounded' bgcolor='#df4e1e'>" . $w_uvindex . "</td>";
			break;
		case $w_uvindex >= 8 and $w_uvindex <= 10;
			$w_uvindex  = "<td class='bg-danger text-right text-white rounded' >" . $w_uvindex . "</td>";
			break;
		case $w_uvindex >= 11;
			$w_uvindex  = "<td class='text-right text-white rounded' bgcolor='#ce1784'>" . $w_uvindex . "</td>";
			break;
	}
}
if ($w_prpInt != 0) {
	$w_prpInt = "<tr><td>Intencidad de Lluvia</td><td class='text-right '>" . $w_prpInt . "mm</td></tr>";
} else {
	$w_prpInt = "";
}

if ($w_temp_st != $w_tempMostrar) {
	$w_tempMostrar = $w_tempMostrar . "&deg;C <br /> ST " . $w_temp_st . "&deg;C <br />";
} else {
	$w_tempMostrar = $w_tempMostrar . "&deg;C - ";
}

// $colorSensor1 = colorSensor($w_temp);⅞

$conn->close();

$w_iconGrande = iconoClima($w_icon);
$mesNombre = mesMostrar();
?>

<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>PikAppWiFi</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- Custom fonts for this template -->
	<link rel="stylesheet" href="./css/all.css">

	<link rel="apple-touch-startup-image" href="images/apple-icon-180x180.png">
	<link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
	<link rel="manifest" href="manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="theme-color" content="#000000">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<link rel="stylesheet" href="./css/style.css">

	<style>
		.bd-mode-toggle {
			z-index: 1500;
		}

		.bd-mode-toggle .dropdown-menu .active .bi {
			display: block !important;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card shadow-sm m-2" style="height: auto; min-height: 350px;">
					<div class="card-header bg-transparent d-flex justify-content-between align-items-center">
						<h3 class="mt-3"><i class="fa-thin fa-map-marker-alt text-primary"></i> <?php echo $w_city; ?></h3>
						<div class="form-check form-switch mb-0">
							<input class="form-check-input p-2" type="checkbox" role="switch" id="themeSwitch" onclick="toggleTheme()">
							<label class="form-check-label ms-1" for="themeSwitch">
								<span id="btn-theme" class="fs-5">
									<i class="fa-regular fa-sun fa-fw"></i>
								</span>
							</label>
						</div>
					</div>
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md-5 text-center border-end">
								<?php echo $w_iconGrande; ?>
								<h6 class="mt-2 text-muted"><?php echo $w_desc; ?></h6>
								<h2 class="display-6 fw-bold"><?php echo $w_tempMostrar; ?></h2>
								<h4 class="text-secondary"><?php echo $w_humedadMostrar; ?>%H</h4>
							</div>
							<div class="col-md-7">
								<table class="table table-sm table-borderless mb-0">
									<tr>
										<th colspan="2" class="text-center text-uppercase small text-muted border-bottom mb-2">Resumen Climático</th>
									</tr>
									<tr>
										<td>Presión</td>
										<td class="text-end fw-bold"><?php echo $w_pressure; ?> hpa</td>
									</tr>
									<tr>
										<td>Viento</td>
										<td class="text-end fw-bold"><?php echo $w_dir; ?> a <?php echo $w_wind; ?> km/h</td>
									</tr>
									<tr>
										<td>Nubes</td>
										<td class="text-end fw-bold"><?php echo $w_cloud; ?>%</td>
									</tr>
									<tr>
										<td>Visibilidad</td>
										<td class="text-end fw-bold"><?php echo $w_visibility; ?> km</td>
									</tr>
								</table>
								<div class="d-flex justify-content-around mt-3 pt-2 border-top">
									<div class="text-center">
										<small class="d-block text-muted">Amanecer</small>
										<span class="h6"><i class="fa-thin fa-sunrise text-warning"></i> <?php echo $amanecer; ?></span>
									</div>
									<div class="text-center">
										<small class="d-block text-muted">Atardecer</small>
										<span class="h6"><i class="fa-thin fa-sunset text-warning"></i> <?php echo $atardecer; ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-transparent text-muted small text-center">
						<i class="fa-thin fa-calendar me-1"></i> Reporte: <?php echo $w_reportm; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
		<!-- /.container-fluid -->
	<script src="./js/bootstrap.bundle.min.js"></script>
	<script src="./js/theme.js"></script>
</body>

</Html>
<!--
necesito calcular el fondo de desempleo de uocra argentina rn base a los recibos de sueldo adjuntos, al dia de hoy
-->