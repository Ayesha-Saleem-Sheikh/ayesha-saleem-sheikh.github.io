let pointsArray = [];
const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");
let movement = null;
const NRSTEPS = 100;  


const btnOne = document.getElementById('btnDisk');
const btnRefresh  = document.getElementById('btnClean');
const btnCollect= document.getElementById('collective');  
const btnMove = document.getElementById('StartAnimate');
const btnReset = document.getElementById('reset');


btnOne.addEventListener('click', () => {
  makenew();
});

btnRefresh.addEventListener('click', () => {
  refresh();
});

btnCollect.addEventListener('click', () => {
  collectivepoints();
});

btnMove.addEventListener('click', () => {
  StartAnimate();
});

btnReset.addEventListener('click', () => {
  reset();
});