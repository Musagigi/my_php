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
	echo '<br>'
	?>

	<?php
	$email = '';
	$password = '';
	$error = '';
	// isset() - исп. для проверки существования пременной или ключа в массиве
	// лучше использовать empty() - Она возвращает true, если переменная не существует или ее значение равно false, 0, пустой строке "", NULL или массиву без элементов. В противном случае, функция возвращает false
	// $_POST['email'] - ерет значение из тега input атрибута name
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (mb_strlen($password, 'UTF-8') < 5) {
			$error = 'пароль должен быть длинее 4 символов';
		}
	}
	?>

	<div>
		<p>Email: <?= $email ?></p>
		<p>Password: <?= $password ?></p>
	</div>

	<?php if ($error) : ?>
		<p><?= $error ?></p>
	<?php endif ?>

	<form action="" method="post">
		<div>
			<label for="email">email:</label>
			<input type="email" id="email" name="email" placeholder="введите почту" value="<?= $email ?>" />
		</div>
		<div>
			<label for="password">password:</label>
			<input type="text" id="password" name="password" placeholder="введите пароль" />
		</div>
		<button type="submit">submit</button>
	</form>
	<br>

	<!-- отправка файлов на сервер -->
	<?php
	var_dump($_FILES);
	if (!empty($_FILES['file']['name'])) {
		// первый параметр временный путь к загруженному файлу 
		// второй параметр куда нужно переместить файл
		move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/' . $_FILES['file']['name']);
	}
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<div>
			<label for="file">загрузите файл:</label>
			<input type="file" name="file" id="file">
		</div>
		<button type="submit">загрузить</button>
	</form>


	<!-- встроенные функции языка -->
	<?php
	// mb_strlen() - считает кол-во символов
	// stristr() - 2 параметра, 1 сама строка, 2 какую подстроку ищем, если находит выдает true иначе false. регистро не зависимая
	// strstr() - как и stristr(), единственное отличие, она строгий регистр
	// strpos() - 2  параметра, выдает позицию в индексах искомой строки
	// substr() - режет строку и выдает подстроку, в указаном диапазоне 0, 3, если нужен конец, просто -1 или -2 и т.д.
	?>

	<?php
	// есть конструкция match - которая оптимизирует констркцию switch
	// если писать через switch, то он выдал бы 'строка', так как он сравнивает значения, но не тип данных
	$tes = match (8.9) {
		'8.9' => 'строка',
		8.9 => 'число',
	};
	echo $tes . '<br>';

	// можно так
	match ('8.9') {
		'8.9' => $tes2 =  'строка',
		8.9 =>  $tes2 = 'число',
	};
	echo $tes2;
	?>
	<br>

	<table>
		<?php
		for ($i = 1; $i < 10; $i++) {
			echo "<tr>";
			for ($j = 1; $j < 10; $j++) {
				echo "<td>" . $i * $j . "</td>";
			}
			echo "</tr>";
		}
		?>
	</table>

	<br>

	<?php
	// МАССИВЫ
	$numss = [1, 2, 4, 5, 6];
	$numss2 = array(1, 2, 3, 4);
	$numss3 = [4 => 1, 3, 5, 6];
	$numss4 = [1 => 1, 2 => 2, 3 => 3];
	// Оператор => позволяет определить свои индексы вручную для элементов, необязательно с нуля и необязательно по порядку:

	// count() - в качестве параметра принимает массив и возвр. его длину.
	// обычный перебор через for лучше не исп, так может быть задана разная нумерация индексов массива как в переменной $numss4

	// лучше исп. foreach
	$users = [1 => "Tom", 4 => "Sam", 5 => "Bob", 21 => "Alice"];
	foreach ($users as $element) {
		echo "$element<br />";
	}

	// Цикл foreach позволяет извлекать не только значения, но и ключи элементов:
	foreach ($users as $key => $value) {
		echo "$key - $value<br>";
	}


	// Ассоциативные массивы представляют подвид массивов, в которых, в отличие от обычных массивов, в качестве ключа применяются строки.

	// При создании ассоциативного массива мы явным образом указываем ключ элемента, после которого идет оператор => и значение элемента.
	$words = ['red' => 'красный', 'blue' => 'глоубой', 'green' => 'зеленый'];
	echo $words['red']; //красный
	// Используя ключ, также как и в обычных массивах, можно обратиться к элементу массива
	// добавление в ассоциативный массив
	$words['brown'] = 'коричневый';
	echo '<br>';
	print_r($words);
	echo '<br>';
	// Для перебора ассоциативного массива применяется цикл foreach:
	foreach ($words as $key => $value) {
		echo "$key - $value<br>";
	}

	// Смешанные массивы
	// PHP позволяет использовать в одном массиве числовые и строковые индексы
	$data = [1 => "Tom", "id132" => "Sam", 56 => "Bob"];
	foreach ($data as $key => $value) {
		echo "$key - $value<br>";
	}
	?>

	<!-- Объединение массивов -->
	<?php
	$arr1 = ['my', 'text'];
	$arr2 = ['foo', 'test'];
	$res = $arr1 + $arr2; // просто так не объединяться
	print_r($res);
	echo '<br>';

	$res2 = array_merge($arr1, $arr2); // объединит массивы
	print_r($res2);
	echo '<br>';
	echo is_array($res2) . ' если 1 является массивом<br>'; // проверка на массив

	// не строгое сравнивание, если добавить 3 параметр, будет строгое равенство
	echo in_array('my', $res2, true) . ' поиск в массиве<br>';

	// если 1 true
	echo array_key_exists(1, $res2) . ' поиск ключа в массиве<br>';
	echo '<br>';

	$numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

	//рандомный элемент из массива 
	$randomIndex = rand(0, count($numbers) - 1);
	echo $numbers[$randomIndex] . '<br>';

	// новый массив с четными числами
	$newNum = [];
	foreach ($numbers as $num) {
		if ($num % 2 === 0) {
			$newNum[] = $num;
		}
	}
	echo '<pre>';
	print_r($newNum);
	echo '</pre>';
	echo '<br>';

	$t = rand(5, 10);
	$tArr = [];
	for ($i = 0; $i < $t; $i++) {
		$tArr[] = rand(0, 100);
	}
	echo '<pre>';
	print_r($tArr);
	echo '</pre>';
	var_dump(sort($tArr, SORT_NUMERIC));
	echo '<br>';


	function test(string ...$items)
	{
		foreach ($items as $item) {
			echo $item . '<br>';
		}
	}

	$ch = ['qw', 'er', 'ty', 'ui'];
	test(...$ch);
	echo '<br>';
	?>

	<?php
	// анонимные функции
	// Анонимная функция определяется как обычная функция за тем исключением, что она не имеет имени. Фактически подобная переменная применяется как стандарт. функция
	$anonFunc = function ($name) {
		echo "<h3>Hello $name</h3>";
	};
	$anonFunc('ivan');


	// Распространенным случаем применения анонимных функций является передача их параметрам других функции. Таким анонимные функции еще называют функциями обратного вызова или коллбеками (callback function). Рассмотрим простейший пример:
	function welcome($message)
	{
		$message();
	}

	$goodMorning = function () {
		echo "<h3>Have a good morning</h3>";
	};
	$goodEvening = function () {
		echo "<h3>Have a good evening</h3>";
	};
	welcome($goodMorning);
	welcome($goodEvening);
	welcome(function () {
		echo 'Hello!';
	});
	echo '<br>';


	// допустим, мы хотим, чтобы функция подсчитывала сумму только тех чисел, которые удовлетворяют определенному условию,Но на момент определения функции мы не знаем, какое условие мы захотим использовать в будущем. И в этом случае мы можем использовать анонимные функции
	function sum(array $numbers,  $condition): int
	{
		$result = 0;
		foreach ($numbers as $number) {
			if ($condition($number)) {
				$result += $number;
			}
		}

		return $result;
	}

	// четные
	$isEvenNum = function ($n) {
		return $n % 2 === 0;
	};
	// только положительные
	$isPositiveNum = function ($n) {
		return $n > 0;
	};

	$myNumbers = [-2, -1, 0, 1, 2, 3, 4, 5];
	$evenSum = sum($myNumbers, $isEvenNum);
	$positiveSum = sum($myNumbers, $isPositiveNum);
	echo "Сумма четных чисел: $evenSum <br /> Сумма положительных чисел: $positiveSum <br>";


	// Замыкание - Closure - работает только
	// с анонимными фукнциями или с functions expression
	$numb = 99;
	$numb2 = 1;

	// выражение use() получает внешние переменные, работает только с анонимными фукнциями или с function expression
	function () use ($numb) {
		return $numb + 1;
	};
	$showClosure = function ($a) use ($numb, $numb2) {
		return ($numb + $numb2) / $a;
	};

	$t = $showClosure(2);
	echo $t . '<br>';

	function hel()
	{
		return 'hel';
	}
	// присвоили имя функции в переменную, 
	// теперь переменная работает как функция
	$he = 'hel';
	echo $he();
	echo '<br>';

	// Стрелочные функции (arrow function) позволяют упростить запись анонимных функций, которые возвращают некоторое значение. И при этом стрелочные функции автоматически имеют доступ к переменным из внешнего окружения.

	// Стрелочная функция определяется с помощью оператора fn:
	// fn(param) => action

	$aa = 8;
	$bb = 2;

	$arrow = fn ($cc) => $aa + $bb + $cc;
	echo $arrow(10);
	echo '<br>';
	// если внутри стрелочной функции поменять значение переменной извне например $aa, ее значение снаружи не изменится

	function testArrow($a, $arrow)
	{
		return $a + $arrow($a);
	}

	$tt = testArrow(500, fn ($num) => $num * 2);
	echo $tt;
	echo '<br>';

	// ССЫЛКИ &&&&&&&
	function square(&$a)
	{
		$a *= $a;
		echo "a = $a";
	}

	$number = 5;
	square($number);
	echo "<br> number = $number<br>";

	// Возвращение ссылки из функции
	// Функция также может возвращать ссылку. В этом случае при определении и вызове функции перед ее именем ставится знак амперсанда:

	// В данном случае функция checkName() получает параметр по ссылке и возвращает ссылку - фактически ссылку, которая передается в функции. Для этого перед определением функции указан символ амперсанда:
	// function &checkName(&$name)
	function &checkName(&$name)
	{
		if ($name === "admin") $name = "Tom";
		return $name;
	}

	$userName = "admin";
	$checkedName = &checkName($userName);
	echo "<br />userName: $userName";
	echo "<br />checkedName: $checkedName <br>";
	$checkedName = 'test';
	echo "<br />userName: $userName поменяли";
	echo "<br />checkedName: $checkedName тоже поменяли<br>";
	// При вызове функции перед ее именем указывается символ амерсанда:
	// $checkedName = &checkName($userName)
	// После выполнения функции переменная $checkedName фактически будет содержать ссылку на переменную $userName.



	// ОБЛАСТЬ ВИДИМОСТИ

	// Блоки циклов и условных конструкций не образуют отдельной области видимости, и переменные, определенные в этих блоках, мы можем использовать вне этих блоков:
	$condition = true;
	if ($condition) {

		$name = "Tom";
	}
	echo $name . '<br> <br>'; // Tom


	// Локальные переменные создаются внутри функции. К таким переменным можно обратиться только изнутри данной функции
	function showName()
	{
		// так же мы просто так не можем обратиться к переменным извне
		// echo $condition; ничего не выведет
		$nameCon = "innerTom";
		echo $nameCon;
	}
	showName();
	echo '<br> teeees' . $nameCon; //  $nameCon - ничего не выведет
	echo '<br>';
	echo '<br>';

	// Статические переменные. Они отличаются тем, что после завершения работы функции их значение сохраняется. При каждом новом вызове функция использует ранее сохраненное значение
	function getCounter()
	{
		static $counter = 0;
		$counter++;
		echo $counter;
	}
	getCounter(); // counter=1
	echo '<br>';
	getCounter(); // counter=2
	echo '<br>';
	getCounter(); // counter=3
	echo '<br>';
	echo '<br>';


	// Глобальные переменные  Для этого необходимо использовать ключевое слово global. Делаются для того чтобы обратиться к внешним переменным
	$name = "Tom";
	function hello()
	{
		global $name;
		echo "Hello " . $name;
	}
	hello();    // Hello Tom
	echo '<br>';
	// В качестве альтернативы оператору global для обащения к глобальным переменным мы можем использовать встроенный массив $GLOBALS

	$name = "Tom";
	function changeName()
	{
		// из-за глобальности внутри можем менять значение переменной
		$username = $GLOBALS["name"];
		echo "Старое имя: $username <br>";
		// изменяем значение переменной $name
		$GLOBALS["name"] = "Tomas";
	}
	changeName();
	echo "Новое имя: " . $name;
	// КОНЕЦ ОБЛАСТЬ ВИДИМОСТИ
	?>
</body>

</html>