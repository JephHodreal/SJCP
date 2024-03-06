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