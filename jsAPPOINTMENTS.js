const navbar = document.querySelector('#nav-wrapper');
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

function openForm(id){
    document.getElementById(id).style.display = "block";
}
function closeForm(id){
    document.getElementById(id).style.display = "none";
}
function openMessage(){
    document.getElementById("canceledConfirm").style.display = "block";
    document.getElementById("submitForm").style.display = "none";
}



function showinput(id) {
    var text = document.getElementById(id.id);
    text.style.display = "block";
    text.disabled = false;
}
function hideinput(id) {
    var text = document.getElementById(id.id);
    text.style.display = "none";
    text.disabled = true;
}

function showoption(id) {
    if (document.getElementById(id).style.display == "none" || document.getElementById(id).style.display == "") {
        document.getElementById(id).style.display = "flex";
    } else {
        document.getElementById(id).style.display = "none";
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

const openclose = item => {
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