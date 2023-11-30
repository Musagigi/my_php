arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
total = 13;
//result = [4, 9]

const firstSum = (arr, total) => {
	let findNum

	for (let i of arr) {
		findNum = total - i

		if (arr.includes(findNum)) {
			return [i, findNum]
		}
	}
}

let result = firstSum(arr, total)
console.log(result);