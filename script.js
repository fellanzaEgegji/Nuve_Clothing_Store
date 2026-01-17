// Hamburger Menu-ja
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".header ul");
const icons = document.querySelector(".icons");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("show");
  icons.classList.toggle("show");
});

// Hero Slider
let i = 0;

let desktopImgs = [
  "library/hero1.webp",
  "library/hero2.webp",
  "library/hero4.webp"
];

let mobileImgs = [
  "library/hero3.jpeg",
  "library/hero5.jpeg"
];

const slideshow = document.getElementById("slideshow");
const nextBtn = document.getElementById("next");
const prevBtn = document.getElementById("previous");

if (slideshow){
  function eshteMobile() {
    return window.innerWidth <= 768;
  }

  function ktheImgs() {
    return eshteMobile() ? mobileImgs : desktopImgs;
  }

  function ndrroImg() {
    const imgs = ktheImgs();
    slideshow.src = imgs[i];
    if(i < imgs.length-1){
      i++;
    } else {
      i = 0;
    }
    setTimeout(ndrroImg, 4000);
  }

  function nextImg() {
    const imgs = ktheImgs();
    i++;
    if(i >= imgs.length) i = 0;
    slideshow.src = imgs[i];
  }

  function prevImg() {
    const imgs = ktheImgs();
    i--;
    if(i < 0) i = imgs.length-1;
    slideshow.src = imgs[i];
  }

  window.addEventListener("load", () => {
    i = 0;
    ndrroImg();
  });

  window.addEventListener("resize", () => {
    i = 0;
    ndrroImg();
  });

  nextBtn.onclick = nextImg;
  prevBtn.onclick = prevImg;
}

// Fillimi i videos
const video = document.getElementById("video");

if (video) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        video.play();
      } else {
        video.pause();
      }
    });
  }, {
    threshold: 0.1
  });

  observer.observe(video);
}

// Validimi i formes se kontaktit
const form = document.getElementById('contact-form');

if (form) {
  const emriRe = /^[a-zA-Z]{3,20}$/;
  const mbiemriRe = /^[a-zA-Z]{3,}$/;
  const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  const phoneRe = /^[0-9]{9,}$/;

  const emri = document.getElementById('emri');
  const mbiemri = document.getElementById('mbiemri');
  const email = document.getElementById('email');
  const phone = document.getElementById('phone');
  const message = document.getElementById('message');

  const emriError = document.getElementById('emriError');
  const mbiemriError = document.getElementById('mbiemriError');
  const emailError = document.getElementById('emailError');
  const phoneError = document.getElementById('phoneError');
  const messageError = document.getElementById('messageError');

  function clearErrors(){
    [emriError, mbiemriError, emailError, phoneError, messageError].forEach(el => el.textContent='');
  }
  function validateField(){
    clearErrors();
    let valid = true;

    if(!emriRe.test(emri.value.trim())){
        emriError.textContent= 'Emri i shkruar nuk është valid!';
        valid=false;
    }
    if(!mbiemriRe.test(mbiemri.value.trim())){
        mbiemriError.textContent= 'Mbiemri i shkruar nuk është valid!';
        valid=false;
    }
    if(!emailRe.test(email.value.trim())){
        emailError.textContent= 'Email-i që keni shkruar nuk është valid!';
        valid=false;
    }
    if(!phoneRe.test(phone.value.trim())){
        phoneError.textContent = 'Numri i telefonit duhet të ketë të paktën 9 shifra!';
        valid=false;
    }
    if(message.value.trim().length < 10){
        messageError.textContent = 'Mesazhi duhet të ketë të paktën 10 karaktere!';
        valid=false;
    }
    return valid;
  }

  emri.addEventListener('input',() => {if(emriRe.test(emri.value.trim())) emriError.textContent='';});
  mbiemri.addEventListener('input',() => {if(mbiemriRe.test(mbiemri.value.trim())) mbiemriError.textContent='';});
  email.addEventListener('input', () => {if(emailRe.test(email.value.trim())) emailError.textContent='';});
  phone.addEventListener('input', () => {if(phone.value.trim().length >= 9) phoneError.textContent='';});
  message.addEventListener('input', () => {if(message.value.trim().length >= 10) messageError.textContent='';});

  form.addEventListener('submit', (e) =>{
    if(!validateField()){
      e.preventDefault();
    }
  });

  const successDiv = form.querySelector('.success');
    if (successDiv && successDiv.textContent.trim() !== "") {
      window.location.href = "index.php";
    }
}


