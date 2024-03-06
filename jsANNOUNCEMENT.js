function openForm(id){
    document.getElementById(id).style.display = "flex";
}
function closeForm(id){
    document.getElementById(id).style.display = "none";
}

const nav = document.getElementById('sideNav');
const bars = document.getElementById('openNav');
const sjcp = document.getElementById('sjcp');
const openNav = () => {
    if (nav.style.width == '0px' || nav.style.width == '') {
        nav.style.width = '250px';
        nav.style.padding = '12px';
        bars.style.display = "none";
        sjcp.style.display = "none";
    } else {
        nav.style.width = '0px';
        nav.style.padding = '0px';
        bars.style.display = "block";
        sjcp.style.display = "unset";
    }
}