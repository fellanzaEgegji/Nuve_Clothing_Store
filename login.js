// Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});
//Validimi i Login Form
const emriMbiemriRe = /^[a-zA-Z\s]{3,}$/;
const passwordRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;


const form = document.getElementById('login-form');
const emriMbiemri = document.getElementById('emri-mbiemri');
const password = document.getElementById('password');
const googleButton = document.querySelector('.google-button');
const appleButton = document.querySelector('.apple-button');

const emriMbiemriError = document.getElementById('emriMbiemriError');
const passwordError = document.getElementById('passwordError');
const formSuccess = document.getElementById('formSuccess');

function clearErrors(){
    [emriMbiemriError, passwordError].forEach(el => el.textContent='');
}

function validateField(){
    clearErrors();
    let valid = true;

    if(!emriMbiemriRe.test(emriMbiemri.value.trim())){
        emriMbiemriError.textContent = 'Emri dhe Mbiemri nuk janë valid!';
        valid = false;
    }
    if(!passwordRe.test(password.value)){
        passwordError.textContent = 'Fjalëkalimi nuk është i saktë!';
        valid= false;
    }
    return valid;
}
emriMbiemri.addEventListener('input', () => {if(emriMbiemriRe.test(emriMbiemri.value.trim())) emriMbiemriError.textContent='';});
password.addEventListener('input', () => {if(passwordRe.test(password.value)) passwordError.textContent = '';});

/*form.addEventListener('submit', (e) =>{
    e.preventDefault();
    if(validateField()){
        formSuccess.textContent = 'Jeni kyçur me sukses!';
        form.reset();

        setTimeout(() => {
            window.location.href = "index.html";
        }, 2000); 
    } else {
        formSuccess.textContent = "";
    }
});*/
googleButton.addEventListener('click', () =>{
    alert('Ky funksionalitet është i simuluar për qëllime demonstrimi. ');
});
appleButton.addEventListener('click', () =>{
    alert('Ky funksionalitet është i simuluar për qëllime demonstrimi. ');
});