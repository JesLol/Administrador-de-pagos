document.addEventListener("DOMContentLoaded", ()=>{
    const historialContainer = document.getElementById("historial-div-container");
    const username = localStorage.getItem("rpsUser");
    const userID = localStorage.getItem("rpsID");
    const meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    function numeroAMes(numeroMes) {
        if (numeroMes >= 1 && numeroMes <= 12) {
            return meses[numeroMes - 1];
        } else {
            return "Mes inválido";
        }
    }
    function mostrarHistorial(datos){
        htmlContent = `<ul class="pago-ul">`;
        datos.forEach((pago)=>{
            htmlContent += `
            <li class="pago-li">
                <div class="user-img-container"><img src="../img/usuario-generico.png" alt="user"></div>
                <div>
                    <p>${numeroAMes(pago.month)} ${pago.year}</p>
                    <p>${pago.fecha_pago}</p>
                    <p>Pagado</p>
                </div>
            </li>`
        });
        htmlContent += `</ul>`;
        historialContainer.innerHTML = htmlContent;
    }
    const datos = {
        username: username,
        userID: userID
    }
    fetch('historial.php', {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(datos)
    })
    .then(response=>{
        const responseCode = response.status;
        console.log(responseCode);
        return response.json();
    })
    .then(data=>{
        console.log(data)
        mostrarHistorial(data);
    })
})