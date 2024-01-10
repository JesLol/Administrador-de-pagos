document.addEventListener("DOMContentLoaded", ()=>{
    const navBtn = document.getElementById("nav-btn");
    const navUlContainer = document.getElementById("nav-ul-container");
    const displayNav = {on: {left: "-450px", top: "-200px"}, off: {left: "-1200px", top: "-500px"}}
    navUlContainer.style.left = "-1200px";
    navBtn.addEventListener("click", ()=>{
        if(navUlContainer.style.left == "-1200px"){
            navUlContainer.style.left = displayNav.on.left;
            navUlContainer.style.top = displayNav.on.top;
        }
        else{
            navUlContainer.style.left = displayNav.off.left;
            navUlContainer.style.top = displayNav.off.top;
        }
    });
});