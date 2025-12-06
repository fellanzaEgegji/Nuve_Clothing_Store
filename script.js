//Hero Slider
var i = 0;
var imgArray = ["library/hero1.webp", "library/hero2.webp"];
function ndrroImg() { 
document.getElementById('slideshow').src = imgArray[i];
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
    document.getElementById('slideshow').src = imgArray[i];
}
function prevImg() {
    i--;
    if (i < 0) i = imgArray.length - 1;
    document.getElementById('slideshow').src = imgArray[i];
}
document.getElementById("next").onclick = nextImg;
document.getElementById("previous").onclick = prevImg;
window.onload = ndrroImg;