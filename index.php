<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
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
	echo $a, B;
	?>
</body>

</html>