<?php
// define('BASEURL', 'http://bdev.local/upbumonitoring/public/');
// define('BASEURL', 'http://192.168.138.95/upbumonitoring/public/');
// define('BASEURL', 'http://192.168.1.21/upbumonitoring/public/');
// // define('BASEURL', 'https://simpelbabullah.online/public/');
// // define('BASEURL', 'https://simpelbabullah.online/');

// define('BASEURL', 'http://localhost/Website-Monitoring-Babullah/public/');
// Cek apakah server menggunakan HTTPS
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Ambil nama server
$host = $_SERVER['SERVER_NAME'];

// Gabungkan protokol dan host
define('BASEURL', "$protocol://$host/Website-Monitoring-Babullah/public/");


// // DB
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', '#admin*');
define('DB_NAME', 'monitoring_upbu_01012024');
// define('DB_PASS', '');
// define('DB_NAME', 'monitoring_upbu_testing');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'u552485360_tifadb');
// define('DB_PASS', '#{Tif4server}');
// define('DB_NAME', 'u552485360_monitoringupbu');