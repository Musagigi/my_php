var displayedImage = document.querySelector('.displayed-img');
var thumbBar = document.querySelector('.thumb-bar');

btn = document.querySelector('button');

var overlay = document.querySelector('.overlay');

btn.addEventListener('click', function (e) {
  if (e.target.classList.contains('dark')) {
    e.target.classList.remove('dark')
    e.target.classList.add('light')
    overlay.style.backgroundColor = 'rgba(0,0,0,0)'
  } else {
    e.target.classList.remove('light')
    e.target.classList.add('dark')
    overlay.style.backgroundColor = 'rgba(0,0,0,0.5)'
  }
})

let i = 1
while (5 >= i) {

  var newImage = document.createElement('img');
  newImage.setAttribute('src', `img/pic${i}.jpg`);
  thumbBar.appendChild(newImage);

  newImage.addEventListener('click', function (e) {

    // Можно так
    // let test = e.target.getAttribute('src')
    // displayedImage.setAttribute('src', test)

    // или так
    displayedImage.src = e.target.src
  })

  i++
}


