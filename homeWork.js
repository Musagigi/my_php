// Задание 4

// 2667. Create Hello World Function
var createHelloWorld = function () {

	return function (...args) {
		return "Hello World"
	}
};

// 2620. Counter
var createCounter = function (n) {

	return function () {
		return n++
	};
};

// 2704. To Be Or Not To Be
var expect = function (val) {

	return {
		toBe(value) {
			if (val === value) { return true }
			else { throw new Error('Not Equal') }
		},

		notToBe(value) {
			if (val !== value) { return true }
			else { throw new Error('Equal') }
		}
	}
};


// 2665. Counter II
var createCounter = function (init) {
	let currentNum = init

	return {
		increment() {
			return currentNum += 1
		},

		decrement() {
			return currentNum -= 1
		},

		reset() {
			return currentNum = init
		}
	}
};


const deepEqual = (obj1, obj2) => {

	for (let i in obj1) {

		if (i === i && typeof obj1[i] === typeof obj2[i]) {
			console.log(obj1[i]);
		}
	}
};

deepEqual({ a: 1, b: 2, c: { d: 1, eFun() { return 'test' } } }, { a: 1, b: 2, c: { d: 1, eFun() { return 'test' } } })