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
        "01d.png" => "<i class='far fa-sun text-warning fa-5x' alt='Soleado'></i>&nbsp;",
        "01n.png" => "<i class='far fa-moon text-info fa-5x'></i>&nbsp;",
        "02d.png" => "<i class='fas fa-cloud-sun text-warning fa-5x'></i>&nbsp;",
        "02n.png" => "<i class='fas fa-cloud-moon text-info fa-5x'></i>&nbsp;",
        "03d.png" => "<i class='fas fa-cloud text-info fa-5x'></i>&nbsp;",
        "03n.png" => "<i class='fas fa-cloud text-info fa-5x'></i>&nbsp;",
        "04d.png" => "<i class='fas fa-cloud text-info fa-5x'></i>&nbsp;",
        "04n.png" => "<i class='fas fa-cloud text-info fa-5x'></i>&nbsp;",
        "09d.png" => "<i class='fas fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "09n.png" => "<i class='fas fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "10d.png" => "<i class='fas fa-cloud-sun-rain text-info fa-5x'></i>&nbsp;",
        "10n.png" => "<i class='fas fa-cloud-moon-rain text-info fa-5x'></i>&nbsp;",
        "11d.png" => "<i class='fas fa-bolt text-warning fa-5x'></i>&nbsp;",
        "11n.png" => "<i class='fas fa-bolt text-warning fa-5x'></i>&nbsp;",
        "13d.png" => "<i class='far fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "13n.png" => "<i class='far fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "50d.png" => "<i class='fas fa-smog text-white fa-5x'></i>&nbsp;",
        "50n.png" => "<i class='fas fa-smog text-white fa-5x'></i>&nbsp;",
        "clear-day" => "<i class='far fa-sun text-warning fa-5x' alt='Soleado'></i>&nbsp;",
        "clear-night" => "<i class='far fa-moon text-info fa-5x'></i>&nbsp;",
        "rain" => "<i class='fas fa-cloud-rain text-info fa-5x'></i>&nbsp;",
        "snow" => "<i class='far fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "sleet" => "<i class='far fa-snowflake text-primary fa-5x'></i>&nbsp;",
        "wind" => "<i class='fas fa-wind text-primary fa-5x'></i>&nbsp;",
        "fog" => "<i class='fas fa-smog text-secondary fa-5x'></i>&nbsp;",
        "cloudy" => "<i class='fas fa-cloud text-info fa-5x'></i>&nbsp;",
        "partly-cloudy-d" => "<i class='fas fa-cloud-sun text-warning fa-5x'></i>&nbsp;",
        "partly-cloudy-n" => "<i class='fas fa-cloud-moon text-info fa-5x'></i>&nbsp;",
        "partly-cloudy-day" => "<i class='fas fa-cloud-sun text-warning fa-lg'></i>&nbsp;",
        "partly-cloudy-night" => "<i class='fas fa-cloud-moon text-info fa-lg'></i>&nbsp;"
    ];

    return $iconMap[$w_icon] ?? "<i class='fas fa-question text-muted fa-5x'></i>&nbsp;"; // Default icon
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

?>