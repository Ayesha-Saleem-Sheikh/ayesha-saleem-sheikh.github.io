
function myFunction(){
	document.getElementById("oldcontent").innerHTML="DUTCH GRAND PRIX";
				}

function changeStyle(){
		let theme = document.getElementById('pagestyle');
		let pic = document.getElementById('header_image');
	
		if(theme.getAttribute('href')== './css/stylesheet.css'){
			theme.setAttribute('href', './css/stylesheet2.css');
			if(pic.getAttribute('src').includes('image/f1.jpg')){
			pic.setAttribute('src', 'image/car.jpg');}
		}
		else {
			theme.setAttribute('href', './css/stylesheet.css')
			if(pic.getAttribute('src').includes('image/car.jpg')){
				pic.setAttribute('src', 'image/f1.jpg');
			}
		}
	}

	