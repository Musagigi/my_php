// --------Задание 1----------
const deepEqual = (obj1, obj2) => {

	let keys1 = getKeyObject(obj1)
	let keys2 = getKeyObject(obj2)

	function getKeyObject(obj) {

		let arr = []

		for (let i in obj) {
			arr.push(i)
		}
		return arr
	}

	if (keys1.length !== keys2.length) {
		console.log('1');
		return false
	}

	keys1.forEach(elem => {
		if (!keys2.includes(elem)) {
			console.log('2');
			return false
		}
	})

	for (let i in obj1) {

		// исправить это условие
		if (typeof obj1[i] === typeof obj2[i] && obj1[i] === obj2[i]) {
			console.log('simple------', obj2[i]);
			if (typeof obj1[i] === 'object' && typeof obj2[i] === 'object') {
				// console.log(obj1[i], '++');
				deepEqual(obj1[i], obj2[i])
			}
			// return true;
			// console.log(obj1[i]);
		} else {
			return false;
		}
	}

	return true;
};

let test1 = deepEqual(
	{
		1: null, 2: false, 3: undefined, a: 1, b: 2,
		c: {
			d: 3,
			eFun() { return 'test' },
			e: {
				123: 'tee',
				q1: [1, 2, 3, 'a']
			},
		},
		d: NaN
	},
	{
		1: null, 2: false, 3: undefined, a: 1, b: 2,
		c: {
			d: 3,
			eFun() { return 'test' },
			e: {
				123: 'tee',
				q1: [1, 2, 3, 'a']
			},
		},
		d: NaN
	},
)

let test2 = deepEqual(
	{
		0: 'ff', 1: null, 2: false, 3: undefined, a: 1, b: 2,
		c: {
			d: 3,
			eFun() { return 'test' },
			e: {
				123: 'tee',
				q1: [1, 2, 3, 'a']
			},
		},
	},
	{
		1: null, 2: false, 3: undefined, a: 1, b: 2,
		c: {
			d: 3,
			eFun() { return 'test' },
			e: {
				123: 'tee',
				q1: [1, 2, 3, 'a']
			},
		},
	},
)

console.log(
	`test1 = ${test1}, 
test2 = ${test2}`
);

// const objx = { a: 5, b: { 'sdf': 'sdfa', 'sdf': { 1: 'sdf' } } }
// deepEqual(objx)

// --------Задание 2----------

// 2635. Apply Transform Over Each Element in Array
var map = function (arr, fn) {

	let newArr = []

	arr.forEach((elem, index) => newArr.push(fn(elem, index)))

	return newArr
};

// 2634. Filter Elements from Array
var filter = function (arr, fn) {

	let filteredArr = []

	arr.forEach((elem, index) => fn(elem, index) && filteredArr.push(elem))

	return filteredArr
};

// 2626. Array Reduce Transformation
var reduce = function (nums, fn, init) {

	if (nums.length === 0) { return init }

	nums.forEach(elem => init = fn(init, elem))

	return init
};



// --------Задание 4----------

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
