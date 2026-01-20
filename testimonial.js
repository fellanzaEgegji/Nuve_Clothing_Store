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
const dotsContainer = document.querySelector('.dots');
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
//funksionalizimi i dots
function createDots() {
    dotsContainer.innerHTML = '';
    let pages = Math.ceil(cards.length / visibleCards);
    for (let i = 0; i < pages; i++) {
        let dot = document.createElement('div');
        dot.classList.add('dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => {
            index = i * visibleCards;
            showCards();
            updateDots();
        });
        dotsContainer.appendChild(dot);
    }
}

function updateDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => dot.classList.remove('active'));
    let activePage = Math.floor(index / visibleCards);
    if (dots[activePage]) dots[activePage].classList.add('active');
}

// thirrjet
window.onload = () => {
    updateVisibleCards();
    createDots();
    showCards();
};

next.onclick = function(){
    index += visibleCards;
    if(index >= cards.length) index = 0;
    showCards();
    updateDots();
}

prev.onclick = function(){
    index -= visibleCards;
    if(index < 0) index = cards.length - visibleCards;
    showCards();
    updateDots();
}

window.addEventListener('resize', () => {
    updateVisibleCards();
    createDots();
    showCards();
    updateDots();
});