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
define("BD_NAME", "");
define("BD_USER", "");
define("BD_PASS", "");
define("BD_DRIVER", "");