document.addEventListener("DOMContentLoaded", ()=>{
    const anchoPantalla = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    const navBtn = document.getElementById("nav-btn");
    const navUlContainer = document.getElementById("nav-ul-container");
    const bgOpacity = document.getElementById("bg-res-main");
    navUlContainer.style.left = `-${anchoPantalla}px`;
    navBtn.addEventListener("click", ()=>{
        if(navUlContainer.style.left==`-${anchoPantalla}px`){
            bgOpacity.style.display = "block";
            navUlContainer.style.left = 0;
        }
        else{
            bgOpacity.style.display = "none";
            navUlContainer.style.left = `-${anchoPantalla}px`;
        }
    });
});