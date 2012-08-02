<?php

// index.php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__FILE__)."/config.php");

// .htaccess поправлен. Запросы вида
// /controllername/actionname/someparameter соответствуют
// index.php?route=controllername/actionname/someparameter

// Распарсим строку
$route = (isset($_REQUEST['route']))?explode('/', $_REQUEST['route']):array();
$r = array('controller','action','v');
foreach ($r as $k => $v) {
	// Заберём нужные параметры
  $params[$v] = isset($route[$k])?trim($route[$k]):NULL;
}

// Автозагрузка классов
function __autoload($classname) {
	$filename = strtolower($classname);
	if (file_exists(dirname(__FILE__)."/controllers/{$filename}.php")) {
		include_once dirname(__FILE__)."/controllers/{$filename}.php";
	} elseif (file_exists(dirname(__FILE__)."/models/{$filename}.php")) {
		include_once dirname(__FILE__)."/models/{$filename}.php";
	} else {
		die('Несуществующий класс!');
	}
}

if (isset($params['controller']) && isset($params['action'])) {
	$controller = strtolower($params['controller']);
	$action = strtolower($params['action']);
} else {
	// Если в параметрах не были указаны контроллер и действие,
	// выполним то, что у нас по умолчанию
	$controller = 'index';
	$action = 'index';
}
// Узнаем название класса
$classname = ucfirst($controller);
$controller = new $classname($params);
// Проверим на существование метода у этого класса
if(method_exists($controller, $action) === false) {
	die('Несуществующий метод!');
}
// Выполним
$result = $controller->$action();

?>