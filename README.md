# ☁️ ApiWheather

[Documentación del Proyecto](file:///home/juan/VirtualMachines/Docker/WebServer/www_data/apiwheather/README.md)

Este proyecto es un sistema de monitoreo climático y API basado en PHP. Automatiza la recolección de datos meteorológicos desde OpenWeatherMap, los almacena en una base de datos MySQL y ofrece múltiples interfaces para consultar la información actual en diversos formatos.

## 1. 🏗️ Arquitectura del Proyecto

El sistema se divide en tres capas principales:

*   **Ingesta de Datos:** El script `cron_api.php` está diseñado para ejecutarse periódicamente (vía Cron). Obtiene datos de OpenWeatherMap y los inserta de forma segura en la base de datos utilizando sentencias preparadas.
*   **Lógica de Negocio:** Centralizada en `funciones.php`, que gestiona conversiones de unidades, mapeo de iconos a emojis y Font Awesome 6 (Thin), y traducción de fechas.
*   **Presentación (Endpoints):** El proyecto ofrece la misma información en múltiples formatos:

### Endpoints Disponibles

| Endpoint | Formato | Descripción |
| :--- | :--- | :--- |
| `json/` | JSON | API de datos climáticos actuales para integraciones programáticas. |
| `csv/` | CSV | Exportación de datos para análisis en hojas de cálculo. |
| `fullhtml/` | HTML completo | Interfaz web interactiva con Bootstrap 5.3 y **soporte nativo para modo oscuro (interruptor persistente)** y Font Awesome. |
| `simplehtml/` | HTML simple | Interfaz web minimalista y accesible de bajo consumo. |
| `txt/` | Texto plano | Reporte climático en texto plano, ideal para terminales o scripts bash. |

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
Configurá una tarea programada (Cron Job) para mantener los datos actualizados de forma autónoma:
```bash
*/15 * * * * /usr/bin/php /ruta/al/proyecto/cron_api.php
```

## 3. 📝 Convenciones de Desarrollo

*   **Seguridad:** Uso estricto de `mysqli` con sentencias preparadas para prevenir inyecciones SQL.
*   **Localización:** Configurado para mostrar meses y descripciones en español (Argentina).
*   **Iconografía:** Mapeo centralizado en `funciones.php` para mantener consistencia visual entre todos los endpoints.
*   **Versionado:** Se sigue el estándar de Versionado Semántico (Major.Minor.Patch).

## 4. 📂 Estructura de Archivos Clave

| Archivo | Tipo / Rol | Descripción |
| :--- | :--- | :--- |
| `cron_api.php` | Script de automatización | Ingiere datos meteorológicos desde OpenWeatherMap y los inserta de manera segura en la base de datos MySQL. |
| `funciones.php` | Biblioteca de funciones | Aloja la lógica de negocio, conversiones de unidades, mapeo de iconos y localización en es_AR. |
| `fullhtml/index.php` | Interfaz visual | Panel web interactivo para los usuarios finales con la interfaz de clima. |
| `json/index.php` | Endpoint API | Expone el estado actual del clima en un formato JSON estandarizado. |
