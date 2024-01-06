document.addEventListener("DOMContentLoaded", ()=>{
    const integrantesContainer = document.getElementById("integrantes-container");
    const username = localStorage.getItem("rpsUser");
    const userID = localStorage.getItem("rpsID");
    function mostrarUsuarios(users){
        usuariosHtml = `
            <ul>
        `;
        users.forEach(user=>{
            borderColor="#ffffff70";
            backgroundColor="#ffffff48";
            if(user == username){
                backgroundColor = '#aaf0ff80';
                borderColor = '#66b3ff80';
            }
            usuariosHtml += `<li class="integrante-card" style="border: 2px solid ${borderColor}; background: ${backgroundColor};"><div><img src="../img/usuario-generico.png" alt="user"></div><div class="user-integrante-card">${user}</div></li>`;
        })
        usuariosHtml += `</ul>`;
        integrantesContainer.innerHTML = usuariosHtml;
    }
    const datos = {
        username: username,
        userID: userID
    }
    fetch('php/integrantes.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(datos)
    })
    .then(response =>{
        return response.json();
    })
    .then(data=>{
        mostrarUsuarios(data);
    })
    .catch(error=>{
        //error
    })
})