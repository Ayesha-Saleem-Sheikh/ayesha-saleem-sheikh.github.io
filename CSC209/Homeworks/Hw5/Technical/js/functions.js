function shape(x,y,r,dx,dy,color,angle){
    var dx = x + Math.cos(angle) * (r + 10);
    var dy = y + Math.sin(angle) * (r + 10);
    ctx.save();
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);
    ctx.strokeStyle = color;
    ctx.lineWidth = 5;
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(x, y);
    ctx.lineTo(dx,dy);
    ctx.strokeStyle = color;
    ctx.lineWidth = 5;
    ctx.stroke();
    }



function randomColor() {
        return '#' + (Math.random() * 0xFFFFFF << 0).toString(16);
    }

function makenew() {
    const x = Math.random() * canvas.width;
    const y = Math.random() * canvas.height;
    const r = Math.random() * (20 - 10) + 10;
    const color = randomColor();
    const angle = Math.random() * 2 * Math.PI;
    const speed = 3;
    const dx = x + Math.cos(angle) * (r + 10);
    const dy = y + Math.sin(angle) * (r + 10);
    const sx = Math.cos(angle) * speed; 
    const sy = Math.sin(angle) * speed; 
    const point = {x, y, r, dx, dy, color, sx, sy,angle , startX: x , startY: y};
    pointsArray.push(point);

    shape(x, y, r, dx, dy, color,angle);
}
 





function StartAnimate(){
    if (movement !==null) return;
         let count = 0;
            movement = setInterval(function(){
                const trace= document.getElementById("trace").checked;
                if (!trace){
                ctx.clearRect(0,0,canvas.width,canvas.height);}
                
                for (let i =0 ; i<pointsArray.length;i++){
                let disk = pointsArray[i];
                disk.x += disk.sx;
                disk.y += disk.sy;
                const arrow = disk.r +10;
                disk.dx = disk.dx + Math.cos(disk.angle) * arrow;
                disk.dy = disk.dy + Math.sin(disk.angle) * arrow;
                shape(disk.x, disk.y, disk.r, disk.dx, disk.dy, disk.color,disk.angle);
            }
             count += 1;
             if (count >= NRSTEPS){
                clearInterval(movement);
                movement = null;
             }
        }, 30);
    }


function collectivepoints(){
    refresh();
    const NRPTS = parseInt(document.getElementById("myNumber").value);

     for (let i =0 ; i<NRPTS;i++){
        makenew();
    }
}
function refresh(){
    if (movement !== null){
        clearInterval(movement);
        movement = null;
    }
    ctx.clearRect(0,0 , canvas.width ,canvas.height);
    pointsArray = [];
    //NRSTEPS= 0;
}

function reset(){
    if (movement !== null){
        clearInterval(movement);
        movement = null;
    }

    for (const point of pointsArray){
        point.x = point.startX;
        point.y = point.startY; 
    } 

     ctx.clearRect(0,0 , canvas.width ,canvas.height);

    for (const point of pointsArray){
          shape(point.x,point.y,point.r,0 ,0,point.color,point.angle);

    }


}



