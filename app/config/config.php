<?php
// define('BASEURL', 'http://bdev.local/upbumonitoring/public/');
// define('BASEURL', 'http://192.168.138.95/upbumonitoring/public/');
// define('BASEURL', 'http://192.168.1.21/upbumonitoring/public/');
// // define('BASEURL', 'https://simpelbabullah.online/public/');
// // define('BASEURL', 'https://simpelbabullah.online/');

define('BASEURL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
    ? "https"
    : "http")
    . "://$_SERVER[HTTP_HOST]" . dirname($_SERVER['SCRIPT_NAME'])
    . (!str_ends_with(dirname($_SERVER['SCRIPT_NAME']), "/") ? "/" : ""));


// // DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'monitoring_upbu');
// define('DB_NAME', 'monitoring_upbu_testing');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'u552485360_tifadb');
// define('DB_PASS', '#{Tif4server}');
// define('DB_NAME', 'u552485360_monitoringupbu');