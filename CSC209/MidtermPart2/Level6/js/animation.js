
function moveBoxes() {
    const container = document.getElementById("mainContainer");
    const squares = document.getElementsByClassName("square");
    const canvas = container.clientWidth - 50; 
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



