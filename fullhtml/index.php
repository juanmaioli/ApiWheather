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

$timezone  = -3;
$latitudActual = -38.94276;
$longitudActual = -68.053724;
$data = date_sun_info(time(), $latitudActual, $longitudActual);

$amanecer = gmdate("H:i:s", $data['sunrise'] + 3600 * ($timezone));
$atardecer = gmdate("H:i:s", $data['sunset'] + 3600 * ($timezone));

//DatosWidget
$sql = "SELECT * FROM cava_weather2 order by w_report desc limit 1";
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
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Plugin CSS -->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/sb-admin.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- <link href="bootstrap3.min.css" rel="stylesheet"> -->
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
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card m-2">
					<div class="card-header">
						<h3 class="mt-3"><i class="fa fa-map-marker-alt text-primary"></i> Ciudad: <?php echo $w_city; ?></h3>
					</div>
					<div class="card-body text-center">
						<div class='card-group'>
							<div class='card'>
								<div class='card-body text-center rounded'>
									<?php echo $w_iconGrande; ?><h6 class="mt-2"><?php echo $w_desc; ?></h6>
									<h3><?php echo $w_tempMostrar; ?> <?php echo $w_humedadMostrar; ?> %H</h3>
								</div>
							</div>
							<div class='card'>
								<div class='card-body text-left'>
									<table class="table table-sm">
										<tr>
											<td colspan="2" class="text-center ">Resumen Climatico</td>
										</tr>
										<tr>
											<td>Presión</td>
											<td class="text-right "><?php echo $w_pressure; ?>hpa</td>
										</tr>
										<tr>
											<td>Viento del</td>
											<td class="text-right "><?php echo $w_dir; ?></td>
										</tr>
										<tr>
											<td>Velocidad</td>
											<td class="text-right "><?php echo $w_wind; ?>km/h</td>
										</tr>
										<tr>
											<td>Porcentaje de nubes</td>
											<td class="text-right "><?php echo $w_cloud; ?>%</td>
										</tr>
										<tr>
											<td>Visibilidad</td>
											<td class="text-right "><?php echo $w_visibility; ?>km</td>
										</tr>
										<tr>
											<td colspan="2"><h5><i class="fas fa-sun text-warning"></i><i class="fas fa-arrow-circle-up text-info"></i> <?php echo $amanecer; ?></h5></td>
										</tr>
										<tr>
											<td colspan="2"><h5><i class="fas fa-sun text-warning"></i><i class="fas fa-arrow-circle-down text-info"></i> <?php echo $atardecer; ?></h5></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-muted"><i class="fa fa-calendar"></i> Fecha reporte : <?php echo $w_reportm; ?> </div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
		<!-- /.container-fluid -->
</body>

</Html>
<!--
necesito calcular el fondo de desempleo de uocra argentina rn base a los recibos de sueldo adjuntos, al dia de hoy
-->