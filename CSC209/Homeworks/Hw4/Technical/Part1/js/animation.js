   
function moveRed()
{   
    var redSquare = document.getElementById("redSq");   
    //initializing position to 0px
    var redPos = 0;
    //setting interval to call stepRed function every 10 milliseconds
    var x = document.getElementById("redSpeed").value;
    var stepRedId = setInterval(stepRed, x);

    function stepRed() {
        //stopping the interval when the position reaches 350px
        if (redPos == 350) {
            clearInterval(stepRedId);
        } else {
            //incrementing position by 1px
            redPos++; 
            redSquare.style.top = redPos + 'px'; 
            redSquare.style.left = redPos + 'px';
        }
    }
}

function moveBlue()
{   //getting the blue square element
    var blueSquare = document.getElementById("blueSq");  
    //initializing position to 350px
    var bluePos = 350;
    //setting interval to call stepBlue function every selected speed milliseconds
     var y = document.getElementById("blueSpeed").value;

    var stepBlueId = setInterval(stepBlue, y);
    function stepBlue() {
        //stopping the interval when the position reaches 0px
        if (bluePos == 0) {
            clearInterval(stepBlueId);
        } else {
            //decrementing position by 1px
            bluePos--; 
            blueSquare.style.top = bluePos + 'px'; 
            blueSquare.style.left = bluePos + 'px';
        }
    }
}


