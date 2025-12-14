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