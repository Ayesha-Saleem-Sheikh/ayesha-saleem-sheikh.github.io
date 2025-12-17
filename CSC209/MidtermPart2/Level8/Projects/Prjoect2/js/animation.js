function moveBoxes(){
    const container = document.getElementById("spacebox");
    const squares = document.getElementsByClassName("sticker");
    const canvas = 350; 
    let x = document.getElementById("Speed").value;
    
    let directions = [];
    for (let i = 0; i < squares.length; i++) {
        directions.push({dx: 1, dy: 1}); 
    }

    setInterval(function() {
        for (let i = 0; i < squares.length; i++) {
            let box = squares[i];

            let top = box.offsetTop;
            let left = box.offsetLeft;

            if (top >= canvas) directions[i].dy = -1;
            if (top <= 0) directions[i].dy = 1;
            if (left >= canvas) directions[i].dx = -1;
            if (left <= 0) directions[i].dx = 1;

        
            box.style.top = (top + directions[i].dy) + "px";
            box.style.left = (left + directions[i].dx) + "px";
        }
    }, x); 
}

function moveRocket() {
    const rocket = document.getElementById("rocket");
    let posX = rocket.offsetLeft;
    let posY = rocket.offsetTop;
    const speed = parseInt(document.getElementById("RocketSpeed").value);

    const step = setInterval(() => {
        if (posX >= 350 || posY <= 0) {
            clearInterval(step);
        } else {
            posX++;
            posY--;
            rocket.style.left = posX + "px";
            rocket.style.top = posY + "px";
        }
    }, speed);
}

function moveAstronaut() {
    const astro = document.getElementById("astonaut");
    let posX = astro.offsetLeft;
    let posY = astro.offsetTop;
    const speed = parseInt(document.getElementById("astoSpeed").value);

    const step = setInterval(() => {
        if (posX >= 350 || posY >= 350) {
            clearInterval(step);
        } else {
            posX++;
            posY++;
            astro.style.left = posX + "px";
            astro.style.top = posY + "px";
        }
    }, speed);
}

function moveAsteroid() {
    const asteroid = document.getElementById("asteroid");
    let posX = asteroid.offsetLeft;
    let posY = asteroid.offsetTop;
    const speed = parseInt(document.getElementById("rockSpeed").value);

    const step = setInterval(() => {
        if (posX <= 0 || posY <= 0) {
            clearInterval(step);
        } else {
            posX--;
            posY--;
            asteroid.style.left = posX + "px";
            asteroid.style.top = posY + "px";
        }
    }, speed);
}

function moveAlien() {
    const alien = document.getElementById("alien");
    let posX = alien.offsetLeft;
    let posY = alien.offsetTop;
    const speed = parseInt(document.getElementById("alienSpeed").value);

    const step = setInterval(() => {
        if (posY>=350|| posX <= 0) {
            clearInterval(step);
        } else {
            posX--;
            posY++;
            alien.style.left = posX + "px";
            alien.style.top = posY + "px";
        }
    }, speed);
}
