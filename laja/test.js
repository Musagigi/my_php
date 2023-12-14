function Test(name, age) {
	this.name = name || ''
	this.age = age || null
}

function Qwe(name, age, employ) {
	Test.call(this, name, age)
	this.employ = employ || false
}

Qwe.prototype = Object.create(Test.prototype)
// Qwe.prototype.constructor = Qwe
Object.defineProperty(Qwe.prototype, 'constructor', {
	value: Qwe,
	writable: true
})

Test.prototype.hello = function () {
	return `hello ${this.name}`
}


let t = new Qwe('Ivan', 0)

Qwe.prototype.ewq = function () {
	return 'test'
}

console.log(t);

// console.log(Object.getOwnPropertyDescriptors(Qwe.prototype));