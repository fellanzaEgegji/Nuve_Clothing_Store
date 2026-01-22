//Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});
//Validimi i Login Form
const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
const passwordRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;


const form = document.getElementById('login-form');
const email = document.getElementById('email');
const password = document.getElementById('password');
const googleButton = document.querySelector('.google-button');
const appleButton = document.querySelector('.apple-button');

const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const formSuccess = document.getElementById('formSuccess');

function clearErrors(){
    [emailError, passwordError].forEach(el => el.textContent='');
}

function validateField(){
    clearErrors();
    let valid = true;

    if(!emailRe.test(email.value.trim())){
        emailError.textContent = 'Email nuk është valid!';
        valid = false;
    }
    if(!passwordRe.test(password.value)){
        passwordError.textContent = 'Fjalëkalimi nuk është i saktë!';
        valid= false;
    }
    return valid;
}
email.addEventListener('input', () => {if(emailRe.test(email.value.trim())) emailError.textContent='';});
password.addEventListener('input', () => {if(passwordRe.test(password.value)) passwordError.textContent = '';});

form.addEventListener('submit', (e) => {
    if (!validateField()) {
        e.preventDefault();
    }
});

googleButton.addEventListener('click', () =>{
    alert('Ky funksionalitet është i simuluar për qëllime demonstrimi. ');
});
appleButton.addEventListener('click', () =>{
    alert('Ky funksionalitet është i simuluar për qëllime demonstrimi. ');
});