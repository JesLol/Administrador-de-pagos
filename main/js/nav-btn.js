document.addEventListener('DOMContentLoaded',()=>{
    const host = "http://localhost/pago-s";
    const inicioBtn = document.getElementById("inicio-nav-btn");
    const historialBtn = document.getElementById("historial-nav-btn");
    const cuentaBtn = document.getElementById("cuenta-nav-btn");
    const adminBtn = document.getElementById("admin-nav-btn");
    const cerrarSesionBtn = document.getElementById("cerrar-sesion-nav-btn");
    function navLink(btn, link){
        btn.addEventListener("click",()=>{
            window.location.href = link;
        });
    }
    navLink(inicioBtn, `${host}/main`);
    navLink(historialBtn, `${host}/historial`);
    navLink(cuentaBtn, `${host}/cuenta`);
    navLink(adminBtn, `${host}/admin`);
    navLink(cerrarSesionBtn, `${host}/main/php/close-session.php`);
});