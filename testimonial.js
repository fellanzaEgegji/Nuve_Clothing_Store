// Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});
//Slider i komenteve
let cards = document.querySelectorAll('.card');
let prev = document.querySelector('.prev');
let next = document.querySelector('.next');

var visibleCards = 3;
var index = 0;

function showCards(){
    for(let i = 0; i < cards.length; i++){
        cards[i].style.display = 'none';
    }
    for(let i = index; i<index + visibleCards; i++){
        if(cards[i]){
            cards[i].style.display = 'block';
        }
    }
}
//button next
next.onclick = function(){
    index += visibleCards;
    if(index >= cards.length) index = 0;
    showCards();
}
//button prev
prev.onclick = function(){
    index -= visibleCards;
    if(index < 0) index = cards.length - visibleCards;
    showCards();
}
window.onload = showCards;
function updateVisibleCards() {
    if (window.innerWidth <= 600) {
        visibleCards = 1;
    } else if (window.innerWidth <= 900) {
        visibleCards = 2;
    } else {
        visibleCards = 3;
    }
    showCards();
}

window.addEventListener('resize', updateVisibleCards);
window.onload = updateVisibleCards;