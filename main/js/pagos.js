document.addEventListener("DOMContentLoaded",()=>{
    const miEstatus = document.getElementById("mi-estatus");
    const username = localStorage.getItem("rpsUser");
    const userID = localStorage.getItem("rpsID");
    const userType = localStorage.getItem("rpsUserType");
    function mostrarEstatus(fechaPago, estatus, mes){
        const fecha = new Date(2023, mes - 1);
        const nombreMes = fecha.toLocaleString('es-MX', { month: 'long' });
        const nombreMesMayuscula = nombreMes.charAt(0).toUpperCase() + nombreMes.slice(1);
        let backgroundColor, borderColor, est;
        if (estatus == 1) {
            //Si estatus es 1 poner verde
            backgroundColor = '#00ff0050';
            borderColor = '#00800080';
            est = "Pagado";
        } else {
            //Estatus es 0 poner rojo
            backgroundColor = '#ff000050';
            borderColor = '#80000080';
            est = "Pendiente";
        }
        htmlContent = `
            <div>
                <div><img src="../img/usuario-generico.png" alt="user"></div>
            </div>
            <div class="fechas-estatus">
                <p>Fecha de pago: ${fechaPago}</p>
                <p>Mes: ${nombreMesMayuscula}</p>
                <p>${est}</p>
            </div>
        `;
        miEstatus.innerHTML = htmlContent;
        miEstatus.style.border = `2px solid ${borderColor}`;
        miEstatus.style.background = backgroundColor;
    }
    const datos = {
        username: username,
        userID: userID,
        userType: userType
    }
    fetch('php/pagos.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(datos)
    })
    .then(response => {
        //const codigoRespuesta = response.status;
        return response.json();
    })
    .then(data => {
        //Si la api no manda ningun mensaje es por que se estan recibiendo los datos de la consulta
        if(data.mensaje == undefined){
            const fechaActual = new Date();
            const mesActual = fechaActual.getMonth() + 1;
            const yearActual = fechaActual.getFullYear();
            if(data != ""){
                data.forEach(dato=>{
                    //Mostrar la fecha de pago del mes y año actual
                    if(dato.month == mesActual && dato.year == yearActual){
                        mostrarEstatus(dato.fecha_pago, dato.pagado, dato.month);
                    }
                });
            }
        }
        else{
            if(data.mensaje == "Registro creado"){
                //Se recarga la pagina ya que se crea un registro y se tiene que actualizar para mostrarse
                window.location.reload();
            }
        }
    })
    .catch(error => {
        //
    });
})