<?php

// config server
define("WEBURL", 'http://admin-web.me');
define("DIROOT", dirname(__DIR__));

// config página web
define("EMPRESA", 'EMPRESA WEB');
define("LIMXPAG", 6);
define('LANG_ACTIVE', false);
define('LANG_DEFAULT', 'es');

// config timezone
date_default_timezone_set("America/Lima");
setlocale(LC_TIME, "spanish");

// config database
define("BD_HOST", "localhost");
define("BD_NAME", "WEB_ADMIN");
define("BD_USER", "postgres");
define("BD_PASS", "valle28");
define("BD_DRIVER", "psql");
