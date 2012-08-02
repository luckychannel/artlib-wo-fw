<?php

// controllers/index.php

// Контроллер по умолчанию.

class Index {

	private $view;
	private $library;

	public function __construct()
	{
		// Мы будем использовать классы View и Library
		$this->view = new View();
		$this->library = new Library();
	}

	function index() {
		// Получим строки
		$output['rows'] = $this->library->booklist();
		// Подготовим к выводу таблицу (вставив полученные строки)
		$output['table'] = $this->view->prepare('table.html', $output);
		// Установим заголовок окна
		$output['pagetitle'] = 'LIBRARY';
		// Подключим стиль
		$output['style'] = SITE_PATH.'views/style.css';
		// Подключим js
		$output['javascript'] = SITE_PATH.'views/script.js';
		// Подготовим к выводу всё
		$output = $this->view->prepare('layout.html', $output);
		// Вывод
		$this->view->draw($output);
	}

}

?>