# Curso Profesional Lumen + React

Un ejemplo de RESTful API creado con Laravel Lumen durante el [Curso Profesional Lumen + React](https://webtraining.zone/cursos/creacion-de-aplicaciones-con-lumen-y-react), disponible en 
[Webtraining.Zone](https://webtraining.zone/cursos/creacion-de-aplicaciones-con-lumen-y-react).

![Curso Profesional Lumen + React](https://webtraining.zone/img/metadata-courses/curso-profesional-lumen-react-2018.jpg)

## Pre-requisitos

1) Este RESTful API fue creado con [Laravel Lumen](https://lumen.laravel.com/), que nos exige una versión moderna de PHP y algunas de sus extensiones instaladas:

```
PHP >= 7.1.3
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
```

Para desarrollo y configuración rápida te recomendamos instalar un meta-paquete como XAMPP 
[descargar aquí](https://www.apachefriends.org/download.html). Sólo hay que estar seguros de descargar
XAMPP con PHP 7.1 (recomendado). Esto te instalará MySQL, PHPMyAdmin, Apache y claro un PHP moderno.

2) También necesitaremos composer ([descargar aquí](https://getcomposer.org/)) para descargar las dependencias de [Laravel Lumen](https://lumen.laravel.com/).

3) Algo que recomendamos es instalar un cliente para probar todos tus *end-points*. 
Nuestra herramienta favorita para tal propósito es [Postman](https://www.getpostman.com/) que tiene una
aplicación gratuita para Windows, GNU/Linux y OS X. Después de instalar Postman puedes **importar** una colección
de *end-points* que hemos creado para ti y que está disponible en: `<REPO>/webtraining/Project Manager API.postman_collection`.

Una vez importada tu colección tendrás acceso a todos los servicios de Lumen como en la siguiente imagen:

![Postman](https://raw.githubusercontent.com/webtrainingmx/rest-api-project-manager-junio-2017/master/webtraining/img/postman-get-users.png)


## Instalación para Desarrollo

1) Instalar dependencias de Composer (ejecutar desde el directorio raiz de este proyecto).
```
composer install
```
2) Configurar base de datos:

Para tu comodidad hemos creado un *MySQL dump* en este archivo `<REPO>/database/sql/project_manager_db_lumen.sql`.
Este archivo contiene dos usuarios, un proyecto y una tarea de demostración.

2.1) Importa esta base de datos usando algún cliente web como PHPMyAdmin o Sequel Pro.
2.2) Crea un usuario que se pueda conectar a esta base de datos, por ejemplo:
```
Base de datos:  project_manager_db_lumen
Usuario:        project_mgr_user_lumen
Constraseña:    D5xNL5LpHPVTxwz4
```

2.3) Crea un archivo llamado `.env` en la raíz de este proyecto, con los siguientes datos:
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:L9X69/CcxQHmSaxJq7cFFmtoJSUJBYla4WiypRCHPDI=
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_manager_db_lumen
DB_USERNAME=project_mgr_user_lumen
DB_PASSWORD=D5xNL5LpHPVTxwz4

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

Lo importante en este caso son los datos de conexión a la base de datos y la generación de tu `APP_KEY` que puedes 
generar usando este [Random Generator](https://webtraining.zone/random-generator).

Para crear un usuario en MySQL podemos usar:

```
CREATE USER 'project_mgr_user_lumen'@'localhost' IDENTIFIED BY 'D5xNL5LpHPVTxwz4';
GRANT ALL PRIVILEGES ON project_manager_db_lumen.* TO 'project_mgr_user_lumen'@'localhost';
FLUSH PRIVILEGES;
```

**Nota para MySQL 8**

Si estás usando MySQL 8, la forma de creación de tu base de datos es como sigue:

```
CREATE SCHEMA `lumen_projects_db` DEFAULT CHARACTER SET utf8 ;
```

3) Iniciar tu servidor en el puerto 8085
```
php -S localhost:8085 -t public
```

## Preguntas Frecuentes

**¿Por qué cuando visito un *end-point*, por ejemplo `/users` veo un código JSON de "Unauthorized"?**

Recuerda que todos los *end-points* de nuestro RESTful API sólo pueden ser llamados utilizando
el *header* **Content-Type** como **application/json** (es decir, con llamados AJAX
debería funcionar correctamente).


**Cuando intento arrancar el servidor en el puerto 8085 me dice que el puerto ya está ocupado ¿cómo lo soluciono?**

Simplemente cambia el puerto de conexión, por ejemplo si queremos arrancar el servidor en el puerto 8089:
```
php -S localhost:8089 -t public
```


## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

### Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

### Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
