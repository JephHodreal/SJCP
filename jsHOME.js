function toggle(input,icon) {
    var pass = document.getElementById(input.id);
    var eye = document.getElementById(icon.id);
    if (pass.type == "password") {
        pass.type = "text";
        eye.className = "fa-solid fa-eye-slash";
    } else {
        pass.type = "password";
        eye.className = "fa-solid fa-eye";
    }
}

const navbar = document.querySelector('.nav-wrapper');
window.onscroll = () => {
    if (window.scrollY > 50) {
        navbar.classList.add('nav-scrolled');
    } else {
        navbar.classList.remove('nav-scrolled');
    }
};

function triggerSideNav() {
    const side = document.querySelector('.nav-content');
    if (side.className === "nav-content") {
        side.className += " responsive";
      } else {
        side.className = "nav-content";
      }
}


// Slideshow script
var timeOut = 3000;
var slideIndex = 0;
var autoOn = true;

autoSlides();

function autoSlides() {
    timeOut = timeOut - 20;

    if (autoOn == true && timeOut < 0) {
        showSlides();
    }
    setTimeout(autoSlides, 20);
}

function prevSlide() {

    timeOut = 3000;

    var slides = document.getElementsByClassName("img-slide");
    var dots = document.getElementsByClassName("dot");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        dots[i].className = dots[i].className.replace(" active-dot", "");
    }
    slideIndex--;

    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    if (slideIndex == 0) {
        slideIndex = 5
    }
    slides[slideIndex - 1].style.display = "flex";
    dots[slideIndex - 1].className += " active-dot";
}

function showSlides() {

    timeOut = 3000;

    var slides = document.getElementsByClassName("img-slide");
    var dots = document.getElementsByClassName("dot");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        dots[i].className = dots[i].className.replace(" active-dot", "");
    }
    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    slides[slideIndex - 1].style.display = "flex";
    dots[slideIndex - 1].className += " active-dot";
}

const login = document.getElementById('login');
const openLogin = () => {
    if (login.style.display == "none" || login.style.display == "") {
        login.style.display = "block"
        document.body.style.height = "100%";
        document.body.style.overflow = "hidden";
    } else {
        login.style.display = "none"
        document.body.style.height = "auto";
        document.body.style.overflow = "unset";
    }
}

const openForm = item => {
    if (document.getElementById(item.id).style.display == "none" || document.getElementById(item.id).style.display == "") {
        document.getElementById(item.id).style.display = "flex";
        document.body.style.height = "100%";
        document.body.style.overflow = "hidden";
    } else {
        document.getElementById(item.id).style.display = "none";
        document.body.style.height = "auto";
        document.body.style.overflow = "unset";
    }
}