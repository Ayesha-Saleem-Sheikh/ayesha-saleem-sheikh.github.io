const themeSel = document.getElementById('theme');
let slideIndex = 1;

if (Array.isArray(THEMES)) {
for (var i = 0; i < THEMES.length; i++) {
var opt = document.createElement('option');
opt.value = THEMES[i];
opt.textContent = THEMES[i];
themeSel.appendChild(opt);
}
}
function loadTheme(themeName) {
document.getElementById('slides').innerHTML = SLIDES_HTML[themeName];
document.getElementById('dots').innerHTML   = DOTS_HTML[themeName]  ;
slideIndex = 1;
showSlides(slideIndex);
}    
if (THEMES && THEMES.length) {
themeSel.selectedIndex = 0;
loadTheme(THEMES[0]);
} 
themeSel.addEventListener('change', function() {
loadTheme(themeSel.value);
});

if (Array.isArray(THEMES) && THEMES.length) {
themeSel.selectedIndex = 0;
loadTheme(THEMES[0]);
} 


themeSel.addEventListener('change', function () {
loadTheme(themeSel.value);
});


//let slideIndex = 1;
//showSlides(slideIndex);

function plusSlides(n) {
showSlides(slideIndex += n);
}

function currentSlide(n) {
showSlides(slideIndex = n);
}

function showSlides(n) {
let i;
let slides = document.getElementsByClassName("mySlides");
let dots = document.getElementsByClassName("dot");
if (n > slides.length) {slideIndex = 1}    
if (n < 1) {slideIndex = slides.length}
for (i = 0; i < slides.length; i++) {
slides[i].style.display = "none";  
}
for (i = 0; i < dots.length; i++) {
dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex-1].style.display = "block";  
dots[slideIndex-1].className += " active";
}
