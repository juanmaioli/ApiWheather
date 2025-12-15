# ☁️ API del Clima

Este proyecto PHP implementa una API simple para obtener datos meteorológicos de OpenWeatherMap y almacenarlos en una base de datos MySQL, además de ofrecer un endpoint JSON y una visualización HTML de los datos actuales.

## 🚀 Características

-   Obtención y almacenamiento automático de datos meteorológicos de OpenWeatherMap.
-   Endpoint JSON (`index.php`) para consumir los datos actuales del clima.
-   Visualización HTML (`txt/index.php`) de los datos actuales.
-   Manejo de zonas horarias para la información de amanecer y atardecer.
-   Conversión de direcciones del viento a puntos cardinales.
-   Mapeo de iconos del clima a emojis y a clases de Font Awesome.

## 🛠️ Refactorizaciones y Mejoras Implementadas

Durante el desarrollo y revisión de este proyecto, se han implementado las siguientes mejoras significativas:

-   **Seguridad:** Se ha corregido una **vulnerabilidad crítica de inyección SQL** en `cronweather.php` mediante la implementación de sentencias preparadas de `mysqli`.
-   **Calidad de Código en `funciones.php`**: Las funciones `mesMostrar()` e `iconoClima()` han sido refactorizadas para utilizar arrays asociativos, mejorando la legibilidad y eficiencia.
-   **Robustez de la API (`index.php`)**:
    -   La generación de la respuesta JSON se ha modernizado, utilizando arrays PHP y `json_encode()` para asegurar una salida correcta y evitar errores de formato manual.
    -   Se ha mejorado la lógica de manejo de datos, incluyendo la inicialización de variables para prevenir advertencias en caso de que no se encuentren registros.
-   **Visualización HTML (`txt/index.php`)**:
    -   Se ha optimizado la forma en que se obtienen y procesan los datos de la base de datos.
    -   La estructura HTML ha sido mejorada para una presentación más limpia y segura, incluyendo `htmlspecialchars()` para la protección contra XSS.
-   **Lógica de `cronweather.php`**: Se ha corregido un error en la función `wind_cardinals()` y se ha eliminado código comentado innecesario para una mayor claridad.
-   **Manejo de Configuración**: Se ha verificado que el archivo `config.php` (que contiene credenciales sensibles) esté correctamente listado en `.gitignore` para prevenir su publicación accidental en repositorios de control de versiones.

## ⚙️ Configuración

1.  **Base de Datos**: Configura tu base de datos MySQL con la tabla `cava_weather2` (o el nombre que definas en `config.php`).
2.  **API Key**: Obtén una clave API de [OpenWeatherMap](https://openweathermap.org/api) y configúrala en `config.php`.
3.  **Credenciales**: Renombra `config_example.php` a `config.php` y rellena tus credenciales de base de datos y la API Key. Asegúrate de que `config.php` no sea subido a tu repositorio.

## 🚀 Uso

-   **`cronweather.php`**: Ejecuta este script periódicamente (por ejemplo, con un cron job) para actualizar los datos meteorológicos en tu base de datos.
-   **`index.php`**: Accede a este archivo a través de tu navegador para obtener la respuesta JSON con los datos actuales del clima.
-   **`txt/index.php`**: Accede a este archivo a través de tu navegador para ver una representación HTML de los datos actuales del clima.
