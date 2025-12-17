
function myFunction(){
document.getElementById("oldcontent").innerHTML="Mon-Friday 10am to 4pm";
			}

function credit(){
  window.open("https://www.w3schools.com/js/default.asp");
}
function dateButton(){
const d = new Date();
const months=  ["January","February","March","April","May","June","July","August","September","October","November","December"];
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
		
	let month = months[d.getMonth()];
	let year= d.getFullYear();
	let date= d.getDate();
	let day = days[d.getDay()];
	document.getElementById("demo").innerHTML = day+", "+ month + " " + date +" "+ year;}
		
	
			
	function changeVis(){
	let vis = document.getElementById('Table');
	let button = document.getElementById('button');
				
	if (vis.style.display == "none"){
		vis.style.display = "table";
		button.innerHTML = "Hide Table";
	}else{
	vis.style.display = 'none';
	button.innerHTML = "Show Table";
}}

function hiderow(){
	let vis = document.getElementById('hiderow');
	let button = document.getElementById('butn');
				
	if (vis.style.display == "none"){
		vis.style.display = 'blovk';
		button.innerHTML = "Hide Table";
	}else{
	vis.style.display = 'none';
	button.innerHTML = "Show Table";
}}

function hiderow2(){
	let vis = document.getElementById('hiderow2');
	let button = document.getElementById('butn2');
				
	if (vis.style.display == "none"){
		vis.style.display = 'block';
		button.innerHTML = "Hide Row 2";
	}else{
	vis.style.display = 'none';
	button.innerHTML = "Show Row 2";
}}
	
		
function changeStyle(){
let theme = document.getElementById('pagestyle');
	if(pagestyle.getAttribute('href')== './css/stylesheet1.css'){
		pagestyle.setAttribute('href', './css/stylesheet2.css');
	} else {
		pagestyle.setAttribute('href', './css/stylesheet1.css')
		}
}
	
	function changeMenu(){
			let theme3 = document.getElementById('pagestyle');
			if(theme3.getAttribute('href')== './css/stylesheet1.css'){
				theme3.setAttribute('href', './css/stylesheet3.css');
			} else{
				theme3.setAttribute('href', './css/stylesheet1.css');
		}}