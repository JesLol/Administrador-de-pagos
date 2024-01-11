document.addEventListener("DOMContentLoaded",()=>{
    const infoBtn = document.getElementById("info-btn");
    infoBtn.addEventListener("click",()=>{
        Swal.fire({
            icon: "info",
            title: "¡Bienvenido!",
            text: "Esta aplicación está diseñada unicamente para llevar un registro y control de los pagos del plan familiar de Spotify.",
            background: "#09092b",
            background: "#fff"
        });
    })
});