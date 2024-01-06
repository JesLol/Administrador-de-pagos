document.addEventListener("DOMContentLoaded",()=>{
    function mensajes( mensaje){
        Swal.fire({
            icon: "info",
            title: mensaje,
            background: "#09092b"
        });
    }
    const form = document.getElementById("login-form");
    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        const username = document.getElementById("username");
        const password =  document.getElementById("password");
        const formData = {
            username: username.value,
            password: password.value
        };
        fetch('php/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            // Recupera el código de respuesta HTTP
            const codigoRespuesta = response.status;
            return response.json();
        })
        .then(data => {
            if(data.mensaje != "sesion iniciada" && data.mensaje!="admin"){
                mensajes(data.mensaje);
            }
            else{
                if(data.mensaje == "admin"){
                    localStorage.setItem("rpsUserType", data.mensaje);
                }
                else{
                    localStorage.setItem("rpsUserType", "usuario")
                }
                localStorage.setItem("rpsUser", data.user);
                localStorage.setItem("rpsID", data.psID);
                window.location.href = "main/"
            }
        })
        .catch(error => {
            //Maneja errores de la solicitud
            //console.error('Error en la solicitud fetch:', error);
        });
    })
})