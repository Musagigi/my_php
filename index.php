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
	?>

	<?php 
	// Классы и объекты
	// public, private, protected - спецификаторы доступа
	// publick - можно обращаться извне и внутри класса
	// privete - можно обращаться только внутри класса
	// protected - исп. при наследовании

		class People {
			public $age; // public - исп. для задания области
			public $name; // видимости переменной
		}

		$ivan = new People;
		$ivan->age = 30;
		$ivan->name = 'Ivan';

		echo $ivan->age;
		echo $ivan->name;
		$ivan = 'перезаписали';
		echo $ivan;
		echo '<br>';


		class Animal {
			public $name;
			protected $age = 5;

			function test() 
			{
				echo $this->age;
			}
		}

		$animal = new Animal();
		$animal->name = 'rabbit';
		$animal->test();
		echo '<br>';

		class Planet {
			public $name;
			protected $age;
		}
	?>
</body>
</html>
 