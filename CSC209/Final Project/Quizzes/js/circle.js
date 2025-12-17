
document.addEventListener('DOMContentLoaded', function() {
  // finding the header element
  const header = document.querySelector('header');
  if (!header) return;
  
  // Create canvas for header background
  const canvas = document.createElement('canvas');
  canvas.style.position = 'absolute';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.width = '100%';
  canvas.style.height = '100%';
  canvas.style.pointerEvents = 'none';
  canvas.style.zIndex = '1';
  
  canvas.width = header.offsetWidth;
  canvas.height = header.offsetHeight;
  
  // Make header positioned relatively
  header.style.position = 'relative';
  header.insertBefore(canvas, header.firstChild);
  
  const ctx = canvas.getContext('2d');
  let circlesArray = [];
  
  // function to create random color
  function randomColor() {
    return '#' + (Math.random() * 0xFFFFFF << 0).toString(16).padStart(6, '0');
  }
  
  // function to create a circle
  function createCircle() {
    const x = Math.random() * canvas.width;
    const y = Math.random() * canvas.height;
    const r = Math.random() * (15 - 8) + 8;
    const color = randomColor();
    const angle = Math.random() * 2 * Math.PI;
    const speed = Math.random() * 0.5 + 0.3;
    const sx = Math.cos(angle) * speed;
    const sy = Math.sin(angle) * speed;
    
    return { x, y, r, color, sx, sy };
  }
  
  // Draw a circle
  function drawCircle(circle) {
    ctx.beginPath();
    ctx.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI);
    ctx.strokeStyle = circle.color;
    ctx.lineWidth = 3;
    ctx.stroke();
  }
  
  // create initial circles 
  for (let i = 0; i < 6; i++) {
    circlesArray.push(createCircle());
  }
  
  // Animate 
  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    for (let i = 0; i < circlesArray.length; i++) {
      let circle = circlesArray[i];
      
      // Move circle
      circle.x += circle.sx;
      circle.y += circle.sy;
      
      // Bounce off edges
      if (circle.x + circle.r > canvas.width || circle.x - circle.r < 0) {
        circle.sx = -circle.sx;
      }
      if (circle.y + circle.r > canvas.height || circle.y - circle.r < 0) {
        circle.sy = -circle.sy;
      }
      
      drawCircle(circle);
    }
    
    requestAnimationFrame(animate);
  }
  
  animate();
  
  // resize canvas on window resize
  window.addEventListener('resize', function() {
    canvas.width = header.offsetWidth;
    canvas.height = header.offsetHeight;
  });
});