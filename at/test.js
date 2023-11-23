let t = Math.random()
console.log(t, t * 10);
let test = 5;

var myData = "Manchester,London,Liverpool,Birmingham,Leeds,Carlisle";
let myArr = myData.split(',')
console.log(myArr);

var cats = ["Билл", "Макс", "Пикси", "Алиса", "Жасмин"];
var info = "Моих кошек зовут ";

for (var i = 0; i < cats.length; i++) {
	if (i === cats.length - 1) {
		info = info.slice(0, -2)
		info += " и " + cats[i] + ".";
	} else {
		info += cats[i] + ", ";
	}
}

console.log(info);
// Object.getPrototypeOf() - Возвращает прототип указанного объекта.
// Object.setPrototypeOf() - Устанавливает прототип (т.е. внутреннее свойство [[Prototype]])
let a = 100

function t111() {

	function tt() {

		function tttt() {
			console.log(a);
		}

		tttt()
	}

	tt()
}

t111()

// console.log(Number.isNaN(NaN));
// console.log(isNaN('22s'));
