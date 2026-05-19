# ☁️ ApiWheather

Este proyecto es un sistema de monitoreo climático y API basado en PHP. Automatiza la recolección de datos meteorológicos desde OpenWeatherMap, los almacena en una base de datos MySQL y ofrece múltiples interfaces para consultar la información actual en diversos formatos.

## 1. 🏗️ Arquitectura del Proyecto

El sistema se divide en tres capas principales:

*   **Ingesta de Datos:** El script `cron_api.php` está diseñado para ejecutarse periódicamente (vía Cron). Obtiene datos de OpenWeatherMap y los inserta de forma segura en la base de datos utilizando sentencias preparadas.
*   **Lógica de Negocio:** Centralizada en `funciones.php`, que gestiona conversiones de unidades, mapeo de iconos a emojis y Font Awesome 6 (Thin), y traducción de fechas.
*   **Presentación (Endpoints):** El proyecto ofrece la misma información en múltiples formatos:
    *   `json/`: API JSON para integraciones programáticas.
    *   `csv/`: Exportación de datos en formato CSV.
    *   `fullhtml/`: Interfaz visual completa con Bootstrap 5.3, **soporte nativo para modo oscuro (interruptor persistente)** y Font Awesome.
    *   `simplehtml/`: Versión HTML simplificada.
    *   `txt/`: Versión en texto plano.

## 2. ⚙️ Configuración y Ejecución

### 🛠️ Requisitos previos
*   Servidor Web (Apache/Nginx) con soporte PHP.
*   Base de Datos MySQL.
*   API Key de [OpenWeatherMap](https://openweathermap.org/api).

### 🚀 Instalación
1.  **Configuración:** Renombrar `config_example.php` a `config.php`.
2.  **Credenciales:** Editar `config.php` con los datos de conexión a la base de datos, la API Key, la ciudad y la zona horaria.
3.  **Base de Datos:** Asegurarse de que la tabla definida en `$dbTable` esté creada con los campos correspondientes.

### ⏰ Automatización
Configura una tarea programada (Cron Job) para mantener los datos actualizados:
```bash
*/15 * * * * /usr/bin/php /ruta/al/proyecto/cron_api.php
```

## 3. 📝 Convenciones de Desarrollo

*   **Seguridad:** Uso estricto de `mysqli` con sentencias preparadas para prevenir inyecciones SQL.
*   **Localización:** Configurado para mostrar meses y descripciones en español (Argentina).
*   **Iconografía:** Mapeo centralizado en `funciones.php` para mantener consistencia visual entre todos los endpoints.
*   **Versionado:** Se sigue el estándar de Versionado Semántico (Major.Minor.Patch).

## 📂 Estructura de Archivos Clave

*   `cron_api.php`: Motor de actualización de datos (reemplaza al antiguo cronweather.php).
*   `funciones.php`: Utilidades y lógica de formateo centralizada.
*   `fullhtml/index.php`: Panel visual principal.
*   `json/index.php`: Endpoint de la API JSON.
