// var card = document.querySelector('.card');
// card.addEventListener( 'click', function() {
//   //card.classList.toggle('is-flipped');
//   myFunction();
// });

// function myFunction() {
//   document.getElementById("testCard1").classList.toggle("is-flipped");
// }
let pos = 0;
let col = [0,0,0];
var x = document.getElementById("testCard").getElementsByTagName("img");
var item = document.querySelectorAll('.carousel');
var carousel = document.querySelector('.carousel');
var cells = carousel.querySelectorAll('.carousel__cell');
var cellCount; // cellCount set from cells-range input value
var selectedIndex = 0;
var cellWidth = carousel.offsetWidth;
var cellHeight = carousel.offsetHeight;
var isHorizontal = false;
var rotateFn = isHorizontal ? 'rotateY' : 'rotateX';
var radius, theta;

// console.log( cellWidth, cellHeight );

function rotateCarousel() {
  var angle = theta * selectedIndex * -1;
  console.log(item);
  item[pos%item.length].style.transform = 'translateZ(' + -radius + 'px) ' + rotateFn + '(' + angle + 'deg)';
}

function valid(n,xn) {
  if ((n%xn.length)>=0) {
    return n%xn.length;
  }else{
    return xn.length +(n%xn.length);
  }
}

document.addEventListener("keyup", function(e){
  var key = e.keyCode
  console.log(key);
  if (key==37) {
    pos--;
    selectedIndex=col[valid(pos,item)];
  }
  if (key==38) {
    selectedIndex--;
    col[valid(pos,item)]=selectedIndex;
    rotateCarousel();
    testValue(valid(selectedIndex,x));
    parametros();
  }
  if (key==39) {
    pos++;
    selectedIndex=col[valid(pos,item)];
  }
  if (key==40) {
    selectedIndex++;
    col[valid(pos,item)]=selectedIndex;
    rotateCarousel();
    testValue(valid(selectedIndex,x));
    parametros();
  }
});

var cellsRange = document.querySelector('.cells-range');
cellsRange.addEventListener( 'change', changeCarousel );
cellsRange.addEventListener( 'input', changeCarousel );

var orientationRadios = document.querySelectorAll('input[name="orientation"]');
( function() {
  for ( var i=0; i < orientationRadios.length; i++ ) {
    var radio = orientationRadios[i];
    radio.addEventListener( 'change', onOrientationChange );
  }
})();

function onOrientationChange() {
  var checkedRadio = document.querySelector('input[name="orientation"]:checked');
  isHorizontal = checkedRadio.value == 'horizontal';
  rotateFn = isHorizontal ? 'rotateY' : 'rotateX';
  changeCarousel();
}

// set initials
onOrientationChange();
seleccion();

// funciones para obtener datos
function testValue(numero) {
  console.log(numero);
  console.log(x[numero].currentSrc);
  return x[numero].currentSrc;
}

function seleccion() {
  for (let i = 0; i < item.length; i++) {
    item[i].addEventListener('click', function(){
      console.log("div presionado es: "+i);
      pos=i;
    });
  }
}

function changeCarousel() {
  cellCount = cellsRange.value;
  theta = 360 / cellCount;
  var cellSize = isHorizontal ? cellWidth : cellHeight;
  radius = Math.round( ( cellSize / 2) / Math.tan( Math.PI / cellCount ) );
  for (let j = 0; j < item.length; j++) {
    var contenedor = item[j].querySelectorAll('.carousel__cell');
    for ( var i = 0; i < contenedor.length; i++ ) {
      console.log(contenedor[i]);
      var cell = contenedor[i];
      if ( i < cellCount ) {
        // visible cell
        cell.style.opacity = 1;
        var cellAngle = theta * i;
        cell.style.transform = rotateFn + '(' + cellAngle + 'deg) translateZ(' + radius + 'px)';
      } else {
        // hidden cell
        cell.style.opacity = 0;
        cell.style.transform = 'none';
      }
    }
  }
  rotateCarousel();
}

function parametros() {
  var n1 = item[0].querySelectorAll('img');
  var n2 = item[1].querySelectorAll('img');
  var n3 = item[2].querySelectorAll('img');
  document.valores.patron1.value = n1[valid(col[0],x)].currentSrc;
  document.valores.patron2.value = n2[valid(col[1],x)].currentSrc;
  document.valores.patron3.value = n3[valid(col[2],x)].currentSrc;
}