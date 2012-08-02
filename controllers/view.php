<?php

// controllers/view.php

class View {

	// Это метод для замены плейсхолдеров в шаблонах на соответствующие им значения
	// В качестве параметров принимает шаблон (T_STRING) и массив,
	// у которого ключи соответствуют плейсхолдерам в шаблоне
	private function setPH($source, $data = array()) {
		$result = $source;
		// Обход массива
		foreach ($data as $ph => $val) {
			if (!is_array($val)) {
				// Если значение не является массиво, то заменим, что найдём
			  $result = preg_replace('/{{'.$ph.'}}/', $val, $result);
			} else {
				// Если же там вложенный массив, то рекурсивно вызовем этот метод
				$result .= $this->setPH($source, $val);
			}
		}
		$result = str_replace($source, '', $result);
		return $result;
	}

	// Подготовка к выводу (здесь мы только получаем готовые к выводу данные)
	public function prepare($filename, $data = NULL) {
		if ($data == NULL) return FALSE;
		// Заберём шаблон
	  $tpl = file_get_contents(APP_PATH.'/views/'.$filename);
		// Обработаем
		$result = $this->setPH($tpl, $data);
		return $result;
	}

	// Собственно вывод
	public function draw($output = NULL) {
	  echo $output;
	}

}

?>