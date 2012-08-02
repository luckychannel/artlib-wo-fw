<?php

// config.php

// Путь к корню приложения
define('APP_PATH', dirname(__FILE__), true);
// Путь к корню сайта
define('SITE_PATH', str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']), true);

// Соединение с базой
$host = "localhost";
$db = "test_db";
$user = "root";
$pass = "root";
$enc = "utf8";

mysql_connect($host, $user, $pass) or exit("Невозможно подключиться к базе данных!");
mysql_select_db($db);
mysql_query("SET NAMES ".$enc);
mysql_query("SET CHARACTER SET ".$enc);

?>