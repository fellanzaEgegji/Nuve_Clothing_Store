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
    e.preventDefault();
    if(validateField()){
      showNotification('Mesazhi u dërgua me sukses 🚀');
      form.reset();

      setTimeout(() => {
          window.location.href = "index.html";
      }, 5000); 
    }
  });
}

// Notification per formen e kontaktit
const notification = document.getElementById('notification');

function showNotification() {
  if (!notification) return;

  notification.classList.add('show');

  setTimeout(() => {
    notification.classList.remove('show');
  }, 3500);
}

