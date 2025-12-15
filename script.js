// Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});

// Hero Slider
var i = 0;
var imgArray = ["library/hero1.webp", "library/hero2.webp"];

const slideshow = document.getElementById('slideshow');
const nextBtn = document.getElementById("next");
const prevBtn = document.getElementById("previous");

function ndrroImg() { 
  slideshow.src = imgArray[i];
  if (i < imgArray.length - 1) { 
      i++;
  } else {
      i = 0;
  }
  setTimeout(ndrroImg, 3000);
}
function nextImg() {
    i++;
    if (i >= imgArray.length) i = 0;
    slideshow.src = imgArray[i];
}
function prevImg() {
    i--;
    if (i < 0) i = imgArray.length - 1;
    slideshow.src = imgArray[i];
}
if (slideshow && nextBtn && prevBtn) {
  window.onload = ndrroImg;
  nextBtn.onclick = nextImg;
  prevBtn.onclick = prevImg;
}

// Fillimi i videos
const video = document.getElementById("video");

if (video) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        video.play().catch(err => console.log("Play error:", err));
      } else {
        video.pause();
      }
    });
  }, {
    threshold: 0.1
  });

  observer.observe(video);
}

