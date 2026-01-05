<?php

//Servidor OnLine
$servername = "localhost";
$username = "juan";
$password = "Lasflores506";
$dbname = "admin_cava";
$zonaHoraria = "-3 hours";

//Servidor Local
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "cava";
// $zonaHoraria = "0 hours";

$fecha = new DateTime(date("Y-m-d H:i:s"));
$fecha->modify($zonaHoraria);
$fecha = $fecha->format('Y-m-d H:i:s');


$c='neuquen';

function wind_cardinals($deg) {
	$cardinal=0;
	$cardinalDirections = array(
		'N' => array(348.75, 360),
		'N' => array(0, 11.25),
		'NNE' => array(11.25, 33.75),
		'NE' => array(33.75, 56.25),
		'ENE' => array(56.25, 78.75),
		'E' => array(78.75, 101.25),
		'ESE' => array(101.25, 123.75),
		'SE' => array(123.75, 146.25),
		'SSE' => array(146.25, 168.75),
		'S' => array(168.75, 191.25),
		'SSO' => array(191.25, 213.75),
		'SO' => array(213.75, 236.25),
		'OSO' => array(236.25, 258.75),
		'O' => array(258.75, 281.25),
		'ONO' => array(281.25, 303.75),
		'NO' => array(303.75, 326.25),
		'NNO' => array(326.25, 348.75)
	);
	foreach ($cardinalDirections as $dir => $angles) {

			if ($deg >= $angles[0] && $deg < $angles[1]) {
				$cardinal = $dir;
			}
		}
		return $cardinal;
}

$html = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$c."&units=metric&lang=es&appid=199f918678e7e48319bdbc62a3610f99");
$json = json_decode($html);

$ciudad = $json->name;
$temp = $json->main->temp;
$presion = $json->main->pressure;
$humedad = $json->main->humidity;
$vel_viento = $json->wind->speed;
$vel_dir = wind_cardinals($json->wind->deg);
$nubes = $json->clouds->all;
$estado_cielo = $json->weather[0]->main;
$descripcion = $json->weather[0]->description;
$icono = $json->weather[0]->icon.".png";
$vel_viento = round(($vel_viento *60*60)/1000);
$visibilidad = $json->visibility / 1000;

$temp_st = $json->main->feels_like;

$dt =  new DateTime(gmdate("Y-m-d H:i:s", $json->dt));
$dt->modify("-3 hours");
$dt = $dt->format('Y-m-d H:i');

$conn = new mysqli($servername, $username,$password,$dbname);

$sql = "INSERT INTO cava_weather2 (
	w_report,
	w_date ,
	w_temp,
	w_humedad ,
	w_wind ,
	w_dir ,
	w_pressure ,
	w_desc ,
	w_icon ,
	w_visibility ,
	w_city ,
	w_cloud,
	w_temp_st
	) VALUES (
		'" . $dt ."',
		'" . $fecha ."',
		" . $temp. ",
		" . $humedad .",
		" . $vel_viento .",
		'" . $vel_dir ."',
		" . $presion .",
		'" . $descripcion ."',
		'" . $icono ."',
		" . $visibilidad .",
		'" .$ciudad ."',
		" . $nubes .",
		" . $temp_st ."
		)" ;
$result = $conn->query($sql);

// $ciudad = "";
// $temp = "";
// $presion = "";
// $humedad = "";
// $vel_viento = "";
// $vel_dir = "";
// $nubes = "";
// $estado_cielo = "";
// $descripcion ="";
// $icono = "";
// $vel_viento ="";
// $visibilidad = "";

// $html = file_get_contents("https://api.darksky.net/forecast/7dc96b6e4d2eae9ec926d62b7f65b58b/-38.94276,-68.053724?lang=es&exclude=minutely,hourly,daily&units=auto");
// //$html = file_get_contents("https://api.darksky.net/forecast/7dc96b6e4d2eae9ec926d62b7f65b58b/-32.96200,-60.63358?lang=es&exclude=minutely,hourly,daily&units=auto");
// $json = json_decode($html);

// $temp = $json->currently->temperature;
// $presion = $json->currently->pressure;
// $humedad = $json->currently->humidity*100;
// $vel_viento = $json->currently->windSpeed;
// $vel_dir = wind_cardinals($json->currently->windBearing);
// $nubes = $json->currently->cloudCover*100;
// $descripcion = $json->currently->summary;
// $visibilidad = $json->currently->visibility;
// $ciudad = "Neuquen";
// $icono =  $json->currently->icon;
// $temp_st = $json->currently->apparentTemperature;
// $precipIntensity =  $json->currently->precipIntensity;
// $precipProbability =  $json->currently->precipProbability;
// $dewPoint =  $json->currently->dewPoint;
// $windGust =  $json->currently->windGust;
// $uvIndex =  $json->currently->uvIndex;
// $ozone =  $json->currently->ozone;
// $fechaUnix = $json->currently->time;
// //echo $fecha;
// $dt =  new DateTime(gmdate("Y-m-d H:i:s", $fechaUnix));
// $dt->modify("-3 hours");
// $dt = $dt->format('Y-m-d H:i');

// echo "temp              " . $temp . "<br>";
// echo "presion           " . $presion . "<br>";
// echo "humedad           " . $humedad . "<br>";
// echo "vel_viento        " . $vel_viento . "<br>";
// echo "vel_dir           " . $vel_dir . "<br>";
// echo "nubes             " . $nubes . "<br>";
// echo "descripcion       " . $descripcion . "<br>";
// echo "visibilidad       " . $visibilidad . "<br>";
// echo "ciudad            " . $ciudad . "<br>";
// echo "icono             " . $icono . "<br>";
// echo "temp_st           " . $temp_st . "<br>";
// echo "precipIntensity   " . $precipIntensity . "<br>";
// echo "precipProbability " . $precipProbability  . "<br>";
// echo "dewPoint          " . $dewPoint . "<br>";
// echo "-----------------windGust          " . $windGust . "<br>";
// echo "uvIndex           " . $uvIndex . "<br>";
// echo "ozone           " . $ozone . "<br>";
// echo "fechaUnix         " . $fechaUnix . "<br>";
//echo $dt;
//$conn = new mysqli($servername, $username,$password,$dbname);

// $sql = "INSERT INTO cava_weather2 (
// 	w_report,
// 	w_date ,
// 	w_temp,
// 	w_humedad ,
// 	w_wind ,
// 	w_dir ,
// 	w_pressure ,
// 	w_desc ,
// 	w_icon ,
// 	w_visibility ,
// 	w_city ,
// 	w_cloud,
// 	w_temp_st,
// 	w_rafagas,
// 	w_prpInt,
// 	w_prpprop,
// 	w_puntorocio,
// 	w_uvindex,
// 	w_ozono)
// VALUES (
// 	'" . $dt ."',
// 	'" .$fecha ."',
// 	" . $temp . ",
// 	" . $humedad .",
// 	" . $vel_viento .",
// 	'" . $vel_dir ."',
// 	" . $presion .",
// 	'" . $descripcion ."',
// 	'" . $icono ."',
// 	" . $visibilidad .",
// 	'" . $ciudad ."',
// 	" . $nubes . ",
// 	" . $temp_st .	",
// 	" . $windGust .	",
// 	" . $precipIntensity .	",
// 	" . $precipProbability .",
// 	" . $dewPoint .	",
// 	" . $uvIndex . ",
// 	" . $ozone . "
// )" ;
// //echo $sql;
// $result = $conn->query($sql);
?>
