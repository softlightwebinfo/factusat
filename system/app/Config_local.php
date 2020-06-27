<?php
# DEFAULT OPTIONS
define("DEFAULT_LAYOUT", "default/");
# Controlador por defecto de la aplicación
define("DEFAULT_CONTROLLER", "index");
define('DEFAULT_METHOD', 'index');
define("IDIOMA", "es");

# URL SYSTEM
define("DOMINIO", "factusat/");
define("DOMINIO_REACT", "/" . DOMINIO);
define("SYSTEMS", "system/");
define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/" . DOMINIO);
define("SYSTEM", BASE_URL . SYSTEMS);
define("BASE_PUBLI", BASE_URL . "public/");
define("BASE_USUARIOS", BASE_PUBLI . "usuarios/");


# Config de la aplicacion
define("APP_NAME", "CODEUNIC");
define("APP_SLOGAN", "CodeUnic slogan...");
define("APP_COMPANY", "www.codeunic.com");
define("APP_EMAIL", 'info@codeunic.com');
define("APP_VERSION", "1.0.0");

# HASH
define("HASH_ALGORITMO", "sha1");
define("HASH_KEY", "5673f53f0b4dc");
define("PASSWORD_RESET", "1234");

# Level Usuario por defecto
define("LEVEL", 4);
define("NIVEL_USER", "usuario");
define("SESSION_TIME", 365);
define('COPYRIGHT', APP_NAME . " &COPY; " . date("Y", time()));
define("DEBUG", true);
define("ONLINE", 3);

# Config
define("NOTIFICACIONES", true);
define("MANTENIMIENTO", false);
define("NUMERO_PAGINACION", 30);

# SEO METAS

# Config del Framework
define("FRAMEWORK_VERSION", "1.3.0");
define("FRAMEWORK_NAME", 'CodeUnic');

# CONSTANTES DE TIEMPO
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
?>
