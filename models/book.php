<?php

// models/book.php

// Работа с БД
// Проверка переменных для запросов сделана в классе Library
// (потому что проверять нужно только 1 переменную)

class Book {

	// Получение списка
	function getlist($page, $limit) {
		$data = array();
		// Узнаем сколько всего записей
		$result = mysql_query("SELECT COUNT(`id`) FROM `books`");
		$total = mysql_result($result,0);
		// Сколько "страниц" мы сможем запросить
		$max_pages = intval(($total - 1) / $limit) + 1;
		if ($page > $max_pages) {
			$page = 1;
		}
		// С какой книги нам нужно начать
		$offset = abs($limit * ($page - 1));
		$result = mysql_query("SELECT `id`, `title` FROM `books` ORDER BY `id` ASC LIMIT $offset, $limit");
		while ($book = mysql_fetch_assoc($result)) {
			$data['books'][] = $book;
		}
		if ($max_pages != $page) {
			// Если мы не "на последней странице", то укажем ещё номер следующей
			$data['next'] = $page + 1;
		}
		return $data;
	}

	// Получение описания
	function getdescription($id) {
		// Ну, тут даже описывать нечего.
		$result = mysql_query("SELECT `description` FROM `books` WHERE `id` = {$id}");
		if (mysql_num_rows($result) != 0) {
			$data = mysql_fetch_assoc($result);
		} else {
			$data = array('description' => 'Нет описания');
		}
		return $data;
	}

}

?>