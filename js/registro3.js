const list_items = document.querySelectorAll('.list-item');
const lists = document.querySelectorAll('.list');
var x = document.getElementById('item').getElementsByTagName('img');

let draggedItem = null;

for (let i = 0; i < list_items.length; i++) {
	const item = list_items[i];

	item.addEventListener('click', function () {
		cardImagenes(item);
	});

	item.addEventListener('dragstart', function () {
		draggedItem = item;
		setTimeout(function () {
			item.style.display = 'none';
		}, 0);
	});

	item.addEventListener('dragend', function () {
		setTimeout(function () {
			draggedItem.style.display = 'block';
			draggedItem = null;
		}, 0);
		cardImagenes(item);
		imprimir(x);
	})

	for (let j = 0; j < lists.length; j ++) {
		const list = lists[j];

		list.addEventListener('dragover', function (e) {
			e.preventDefault();
		});
		
		list.addEventListener('dragenter', function (e) {
			e.preventDefault();
			this.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
		});

		list.addEventListener('dragleave', function (e) {
			this.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
		});

		list.addEventListener('drop', function (e) {
			this.append(draggedItem);
			this.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
		});
	}
}

function imprimir(n) {
	for (item = 0; item < n.length; item++) {
		if (n.length>=3) {
			console.log(n[item].currentSrc);
		}
	}
}

function cardImagenes(item) {
	var imagenSrc = item.getElementsByTagName("img");
	var textoSrc = item.getElementsByTagName("p");
	var element = document.querySelectorAll('.card');

	element[6].style.backgroundImage = 'url("'+imagenSrc[0].currentSrc+'")';
	
	var codeElement = document.getElementById("code");
	var charElements = codeElement.getElementsByClassName("char");
	var nuevo = textoSrc[0].textContent;

	for (j = 0; j < nuevo.length; j++) {
		console.log('entro y el valor es: '+nuevo[j]);
		charElements[j].innerText = nuevo[j];
	}
	console.log(imagenSrc[0].currentSrc);
}

function setValor(){
	var testcry=document.querySelectorAll('.lists > .list > .list-item > .card > p#texto');
	if (testcry.length<3) {
		alert('Organice y posiciones las tarjetas en los campos requeridos');
		event.preventDefault();
	}else{
	document.valor.valor1.value = testcry[0].textContent;
	document.valor.valor2.value = testcry[1].textContent;
	document.valor.valor3.value = testcry[2].textContent;
	}
  }