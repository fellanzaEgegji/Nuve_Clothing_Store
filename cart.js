//Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});

document.querySelectorAll('.cart-item').forEach(item => {
    const minus = item.querySelector('.minus');
    const plus = item.querySelector('.plus');
    const input = item.querySelector('input[type="number"]');

    minus.addEventListener('click', () => {
        if(input.value > 1){
            input.value--;
        }
    });

    plus.addEventListener('click', () => {
        input.value++;
    });
});