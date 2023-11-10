<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php
	/*
		Предопределенные переменнные - содержат разные служебные данные и другую информацию

		$GLOBALS - ссылки на все переменные глобальной области видимости
		$_SERVER - информация о сервере и среде исполнения
		$_GET - переменные http get
		$_POST - переменные http post
		$_FILES - переменные файлов, загруженных по http
		$_REQUEST - переменные http-запроса
		$_SESSION - переменные сессии
		$_ENV - переменные окружения
		$_COOKIE - http cookies
 		$php_errormsg - предыдущее сообщение об ошибке
		$http_response_header - заголовки ответов http
		$argc - количество аргументов, переданных скрипту
		$argv - массив переданных скрипту аргументов
		*/
	?>

	<?php
	// область видимости
	// функция не видит переменные за своими пределами, только если прописать внутрии нее global varName - не рекомендуется к использованию
	$a = 1;

	function my()
	{
		global $a;
		var_dump($a);
	}
	my();
	var_dump($a);

	echo '<br>';


	function my2()
	{
		// static позволяет брать значение переменной с последнего вызова
		// если вызвать 5 раз, то значени будет от 1 до 5,
		// без static как обычно функция объявлялась по новой со стартовыми значениями
		static $a = 10;
		$b = 0;
		$b++;
		$a++;
		var_dump($a, $b);
	}

	my2();
	my2();
	my2();
	?>

	<?php
	// Импорт php-файла
	// require ... - выдаст ошибку если подкл, файл отсут
	// require_once ... - если несколко раз подкл, один и тот же файл, не выдаст ошибку
	// include 'second.php'; - не выдаст ошибку
	// чтобы абсолютный путь никогда не сбивался лучше писать так
	require_once __DIR__ . '/test/test.php'
	?>

	<?php
	// Классы и объекты
	// public, private, protected - спецификаторы доступа, формируют область видимости
	// public - можно обращаться извне и внутри класса
	// privete - можно обращаться только внутри класса
	// protected - исп. при наследовании
	// Если св-вам и методам не указывать спецификатор доступа, по умолчанию будет устанавливаться public

	class People
	{
		public $name;
		public $age;
		public static $year = 2023;
	}

	// :: - оператор расширения области видимости
	echo People::$year;
	echo '<br>';

	$iva = new People();
	echo $iva->age = 33;
	echo '<br>';

	$pet = $iva;
	$pet->age = 35;
	echo $pet->age;
	echo '<br>';

	echo $iva->age;
	echo '<br>';

	class MyClass
	{
		const CONST_VALUE = 'Значение константы';
	}

	$classname = 'MyClass';
	echo $classname::CONST_VALUE;

	echo MyClass::CONST_VALUE;

	class OtherClass extends MyClass
	{
		public static $my_static = 'статическая переменная';

		public static function doubleColon()
		{
			echo parent::CONST_VALUE . "\n";
			echo self::$my_static . "\n";
		}
	}

	$classname = 'OtherClass';
	$classname::doubleColon();

	OtherClass::doubleColon();
	?>

	<br>
	<?php
	echo 'имя файла' . __FILE__ . '</br>';
	echo 'имя директории' . __DIR__ . '</br>';
	$a = 1;
	define('B', 'test');
	echo $a, B, '<br>';

	// арифметические операторы как и в js
	// точка тут считается конкатенацией
	// (int) округляет дробное число до целого 
	echo (int)(5 / 3) . PHP_EOL;
	echo (5 / 3) . PHP_EOL;
	?>

	<?php
	date_default_timezone_set('Europe/Moscow');
	$currentHour = date('H');
	$timels = 0;

	if ($currentHour >= 23 || $currentHour <= 6) {
		echo $timels = 1;
	} elseif ($currentHour >= 7 || $currentHour <= 15) {
		echo $timels = 2;
	} elseif ($currentHour >= 16 || $currentHour < 23) {
		echo $timels = 3;
	}
	?>

	<?php
	if ($timels === 1) :
	?>
		<h1>Сейчас ночь</h1>
	<?php
	elseif ($timels === 2) :
	?>
		<h1>Сейчас день</h1>
	<?php
	elseif ($timels === 3) :
	?>
		<h1>Сейчас вечер</h1>
	<?php endif ?>

	<?php
	$file = './hello.txt';
	file_put_contents($file, 'hello');
	echo file_get_contents($file);
	?>

	<br>

	<?php
	$c = [];
	for ($i = 0; $i < 5; $i++) {
		$c[] = rand(0, 100);
	}
	var_dump($c);
	echo '<br>';

	// для массива обычный for не используется
	for ($i = 0; $i < count($c); $i++) {
		echo $c[$i];
		echo '<br>';
	}
	echo '<br>';

	// для массива используем foreach
	foreach ($c as $index => $item) {
		echo $index . ' ' . $item . '<br>';
	}
	echo '<br>';

	$max = null;
	foreach ($c as $item) {
		if ($item > $max) {
			$max = $item;
		}
	}
	echo $max . " max numbrt for array \$c" . '<br>';

	// знак ампресанда (&) позволяет работать непосредственно со значениями из массива, тем самым мы меняем исходный массив
	foreach ($c as &$item) {
		$item = 0;
	}
	// все значения равны 0
	var_dump($c);
	echo '<br>';

	$d = ['ivan', 'petr'];

	foreach ($d as &$item) {
		$item = 'Name: ' . $item;
	}
	// unset - уничтожает переданный аргумент
	// если не прописать то переменная так как указывает на массив
	// будет существовать за пределами foreach в ней будет хранится 
	// ссылка на последнее значение массив, поэтому нужно явно уничтожать
	// это все из-за & - амперсанда
	unset($item);
	echo $item;
	var_dump($d);
	echo '<br>'
	?>

	<?php

	// можно добавлять тип данных для параметров и для возвр. значения
	// делать значение по умолчанию
	function calc(int $a, int $b, string $oper = '+'): int|string
	{
		switch ($oper) {
			case '+':
				$c = $a + $b;
				break;
			case '-':
				$c = $a - $b;
				break;
			default:
				$c = 'некорректный оператор';
				break;
		}

		return $c;
	}

	$result = calc(10, 4);
	echo "result fun calc: $result <br>";
	$result = calc(10, 4, '-');
	echo "result fun calc: $result <br>";
	$result = calc(10, 4, '*');
	echo "result fun calc: $result <br>";


	// spread operator
	function calc2(...$a): array
	{
		return $a;
	}
	$spread = calc2(1, 2, 3, 4, 5);
	print_r($spread);
	?>


	<form action="./index.php" method="post">
		<div>
			<label for="email">email:</label>
			<input type="email" id="email" placeholder="введите почту" />
		</div>
		<div>
			<label for="password">password:</label>
			<input type="text" id="password" placeholder="введите пароль" />
		</div>
		<button type="submit">submit</button>
	</form>
</body>

</html>