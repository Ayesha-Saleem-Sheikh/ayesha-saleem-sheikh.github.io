const themeSel = document.getElementById('theme');
let slideIndex = 1;

const background={
    All : "#45663F",
    Shaggy:"#B8BE19",
    Daphne:"#E4A0F7",
    Velma:"#FF5C00",
    Fred: "#6495ED",
    Scooby:"#7B3F00",
};

const info={
    All : "Scooby-Doo, Where Are You! is an American animated comedy television series created by Joe Ruby and Ken Spears and produced by Hanna-Barbera for CBS. ",
    Shaggy:"Norville Shaggy Rogers is a fictional character and one of the main characters in the Scooby-Doo franchise. He is characterized as an amateur detective, and the long-time best friend of his dog, Scooby-Doo.",
    Daphne:"Daphne Blake, often referred to just as Daphne,[a] is a fictional character in the Scooby-Doo franchise. She is a core member of Mystery Incorporated and is depicted as coming from a wealthy family. She is noted for her beauty, fashion sense, and her knack for getting into danger, hence the nickname Danger-Prone Daphne.",
    Velma:"Velma Dinkley is a fictional character in the Scooby-Doo franchise.[3] She is usually seen wearing a baggy orange turtleneck sweater, a short red pleated skirt, knee high socks, Mary Jane shoes, and a pair of black square glasses, which she frequently loses and is unable to see without. She is seen as the brains of the group and also serves as Fred Jones' third-in-command.[4][5].",
    Fred: "Fred Jones is a fictional character in the American animated series Scooby-Doo, leader of a quartet of teenage mystery solvers and their Great Dane companion, Scooby-Doo. Fred has been primarily voiced by Frank Welker since the character's inception in 1969.",
    Scooby:"Scooby Doo is a fictional cartoon character and protagonist of the eponymous animated television franchise created in 1969 by the American animation company Hanna-Barbera.[1] He is a male Great Dane and lifelong companion of amateur detective Shaggy Rogers, with whom he shares many personality traits.",

};

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
changebackgroundinfo(themeName);
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



function changebackgroundinfo(themeName){
    const color = background[themeName];
    const about = info[themeName];
    document.body.style.backgroundColor = color;
    document.getElementById("info").innerHTML= about;
}

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
