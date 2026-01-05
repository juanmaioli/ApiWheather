<?php

function mesMostrar() {
    $meses = [
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    ];
    $mesActual = (int)date("m");
    return $meses[$mesActual] ?? "Mes desconocido";
}

function iconoClima($w_icon) {
    $iconMap = [
        "01d.png" => "<i class='fa-thin fa-sun text-warning fa-5x' alt='Soleado'></i>&nbsp;",
        "01n.png" => "<i class='fa-thin fa-moon text-info fa-5x'></i>&nbsp;",
        "02d.png" => "<i class='fa-thin fa-cloud-sun text-warning fa-5x'></i>&nbsp;",
        "02n.png" => "<i class='fa-thin fa-cloud-moon text-info fa-5x'></i>&nbsp;",
        "03d.png" => "<i class='fa-thin fa-cloud text-info fa-5x'></i>&nbsp;",
        "03n.png" => "<i class='fa-thin fa-cloud text-info fa-5x'></i>&nbsp;",
        "04d.png" => "<i class='fa-thin fa-cloud text-info fa-5x'></i>&nbsp;",
        "04n.png" => "<i class='fa-thin fa-cloud text-info fa-5x'></i>&nbsp;",
        "09d.png" => "<i class='fa-thin fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "09n.png" => "<i class='fa-thin fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "10d.png" => "<i class='fa-thin fa-cloud-sun-rain text-info fa-5x'></i>&nbsp;",
        "10n.png" => "<i class='fa-thin fa-cloud-moon-rain text-info fa-5x'></i>&nbsp;",
        "11d.png" => "<i class='fa-thin fa-bolt text-warning fa-5x'></i>&nbsp;",
        "11n.png" => "<i class='fa-thin fa-bolt text-warning fa-5x'></i>&nbsp;",
        "13d.png" => "<i class='fa-thin fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "13n.png" => "<i class='fa-thin fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "50d.png" => "<i class='fa-thin fa-smog text-white fa-5x'></i>&nbsp;",
        "50n.png" => "<i class='fa-thin fa-smog text-white fa-5x'></i>&nbsp;",
        "clear-day" => "<i class='fa-thin fa-sun text-warning fa-5x' alt='Soleado'></i>&nbsp;",
        "clear-night" => "<i class='fa-thin fa-moon text-info fa-5x'></i>&nbsp;",
        "rain" => "<i class='fa-thin fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "snow" => "<i class='fa-thin fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "sleet" => "<i class='fa-thin fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "wind" => "<i class='fa-thin fa-wind text-primary fa-5x'></i>&nbsp;",
        "fog" => "<i class='fa-thin fa-smog text-secondary fa-5x'></i>&nbsp;",
        "cloudy" => "<i class='fa-thin fa-cloud text-info fa-5x'></i>&nbsp;",
        "partly-cloudy-d" => "<i class='fa-thin fa-cloud-sun text-warning fa-5x'></i>&nbsp;",
        "partly-cloudy-n" => "<i class='fa-thin fa-cloud-moon text-info fa-5x'></i>&nbsp;",
        "partly-cloudy-day" => "<i class='fa-thin fa-cloud-sun text-warning fa-lg'></i>&nbsp;",
        "partly-cloudy-night" => "<i class='fa-thin fa-cloud-moon text-info fa-lg'></i>&nbsp;"
    ];

    return $iconMap[$w_icon] ?? "<i class='fa-thin fa-question text-muted fa-5x'></i>&nbsp;"; // Default icon
}

function iconoClimaEmoji($w_icon) {
    $iconMap = [
        // Iconos de OpenWeatherMap (ej. 01d.png)
        "01d.png" => "☀️", // Soleado (día)
        "01n.png" => "🌙", // Noche despejada
        "02d.png" => "⛅", // Pocas nubes (día)
        "03n.png" => "☁️", // Nubes dispersas (noche)
        "04d.png" => "☁️", // Nubes rotas (día)
        "04n.png" => "☁️", // Nubes rotas (noche)
        "09d.png" => "🌧️", // Lluvia de chubascos (día)
        "09n.png" => "🌧️", // Lluvia de chubascos (noche)
        "10d.png" => "🌦️", // Lluvia (día)
        "10n.png" => "🌧️🌙", // Lluvia (noche)
        "11d.png" => "⛈️", // Tormenta (día)
        "11n.png" => "⛈️", // Tormenta (noche)
        "13d.png" => "❄️", // Nieve (día)
        "13n.png" => "❄️", // Nieve (noche)
        "50d.png" => "🌫️", // Niebla/Neblina (día)
        "50n.png" => "🌫️", // Niebla/Neblina (noche)

        // Otras convenciones (ej. Dark Sky)
        "clear-day" => "☀️",
        "clear-night" => "🌙",
        "rain" => "🌧️",
        "snow" => "❄️",
        "sleet" => "🌨️", // Aguanieve
        "wind" => "🌬️", // Viento
        "fog" => "🌫️", // Niebla
        "cloudy" => "☁️", // Nublado
        "partly-cloudy-d" => "⛅", // Parcialmente nublado (día)
        "partly-cloudy-n" => "☁️🌙", // Parcialmente nublado (noche)
        "partly-cloudy-day" => "⛅", // Parcialmente nublado (día)
        "partly-cloudy-night" => "☁️🌙" // Parcialmente nublado (noche)
    ];

    // Buscar el emoji en el mapa. Si no se encuentra, devolver un emoji predeterminado.
    return $iconMap[$w_icon] ?? "❓"; // Emoji de interrogación para iconos no mapeados
}

function wind_cardinals($deg) {
    // Handle the North case which wraps around 360/0
    if ($deg >= 348.75 || $deg < 11.25) {
        return 'N';
    }

    $cardinalDirections = [
        'NNE' => [11.25, 33.75],
        'NE'  => [33.75, 56.25],
        'ENE' => [56.25, 78.75],
        'E'   => [78.75, 101.25],
        'ESE' => [101.25, 123.75],
        'SE'  => [123.75, 146.25],
        'SSE' => [146.25, 168.75],
        'S'   => [168.75, 191.25],
        'SSO' => [191.25, 213.75],
        'SO'  => [213.75, 236.25],
        'OSO' => [236.25, 258.75],
        'O'   => [258.75, 281.25],
        'ONO' => [281.25, 303.75],
        'NO'  => [303.75, 326.25],
        'NNO' => [326.25, 348.75]
    ];

    foreach ($cardinalDirections as $dir => $angles) {
        if ($deg >= $angles[0] && $deg < $angles[1]) {
            return $dir;
        }
    }
    return 'N/A';
}
?>