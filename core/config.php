<?php

// config server
define("WEBURL", 'http://admin-web.me');
define("DIROOT", dirname(__DIR__));

// config pagweb
define("EMPRESA", 'EMPRESA WEB');
define("LIMXPAG", 6);

// config timezone
date_default_timezone_set("America/Lima");
setlocale(LC_TIME, "spanish");

// config database
define("BD_HOST", "localhost");
define("BD_NAME", "WEB_PRUEBA");
define("BD_USER", "postgres");
define("BD_PASS", "valle28");
define("BD_DRIVER", "psql");