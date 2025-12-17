const TEMPLATE = `<div class="mySlides fade">
                  <div class="numbertext"> Number</div>
                  <img src="Images" style="width:100%">
                  <div class="text">caption</div>
                </div>`;

function createSlides() {
    let slidesHTML = "";
    let dotsHTML = "";

    for (let i = 0; i < slidesData.length; i++) {
        const slide = TEMPLATE
            .replace("Number", `${i + 1} / ${slidesData.length}`)
            .replace("Images", slidesData[i].src)
            .replace("caption", slidesData[i].caption);

        slidesHTML += slide;
        dotsHTML += `<span class="dot" onclick="currentSlide(${i + 1})"></span>`;
    }

    document.getElementById("slides").innerHTML = slidesHTML;
    document.getElementById("dots").innerHTML = dotsHTML;
}

createSlides();


let slideIndex = 1;
showSlides(slideIndex);

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
