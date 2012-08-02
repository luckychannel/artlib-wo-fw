<?php

// controllers/library.php

class Library {

	public $_params;
	private $view;
	private $book;

	public function __construct($params = NULL)
	{
		// Получим переданные параметры и используем классы View и Book (модель)
		$this->_params = $params;
		$this->view = new View();
		$this->book = new Book();
	}

	// Вывод списка книг
	public function booklist($page = 1, $limit = 10) {
		if (isset($this->_params['v'])) $page = (int)$this->_params['v'];
		$library = $this->book->getlist($page, $limit);
		// Здесь мы готовим к выводу строки таблицы и кнопку "Показать ещё"
		$result = $this->view->prepare('row.html', $library);
		$result .= $this->view->prepare('next.html', $library);
		// Если мы грузим не первую страницу, то сразу отрисуем
		if ($page != 1) $this->view->draw($result);
		// Иначе просто вернём подготовленные строки
		return $result;
	}

	// Вывод описания одной книги
	public function bookinfo() {
		$id = (int)$this->_params['v'];
		$description = $this->book->getdescription($id);
		$result = $this->view->prepare('description.html', $description);
		// После подготовки можно сразу выводить
		$this->view->draw($result);
	}

}

?>