const dropdown = document.getElementById("dropdown");   
const pictures = document.querySelectorAll("img[data-id]"); 


dropdown.onchange = function() {
  const chosen = dropdown.value;  

  pictures.forEach(pic => {
    if (chosen === "all" || pic.dataset.id === chosen) {
      pic.style.display = "block";  
    } else {
      pic.style.display = "none";   
    }
  });
};
