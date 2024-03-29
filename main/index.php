<?php 
session_start();
if(!isset($_SESSION['aH7rP8sJ3xGvFbK']) && !isset($_SESSION['V6jFpW2qL9aZbR8'])){
    header("location: ../");
    ?><script>window.location.href = '../';</script><?php
    echo session_status();
    session_destroy();
    die();
}else{
    include_once '../php/conex.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Spotify</title>
    <link rel="icon" href="../img/spotify-icon.ico">
    <link rel="stylesheet" href="main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/pagos.js"></script>
    <script src="js/integrantes.js"></script>
    <script src="js/nav-res.js"></script>
    <script src="js/nav-btn.js"></script>
    <script src="js/info-btn.js"></script>
</head>
<body>
    <header class="header-container">
        <nav class="login-nav">
            <img src="../img/spotify-icon.png" alt="spotify-icon" class="nav-logo-sp">
            <div id="nav-ul-container">
                <div>
                    <ul class="nav-ul">
                        <li><button id="inicio-nav-btn">Inicio</button></li>
                        <li><button id="historial-nav-btn" class="historial-nav-btn">Historial de pagos</button></li>
                        <li><button id="cuenta-nav-btn" class="cuenta-nav-btn">Cuenta</button></li>
                        <li><button id="admin-nav-btn" class="admin-nav-btn">Admin</button></li>
                        <li><button id="cerrar-sesion-nav-btn" class="cerrar-sesion-nav-btn">Cerrar Sesion</button></li>
                    </ul>
                </div>
            </div>
            <div class="nav-btn-container">
                <button id="nav-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="28" width="24" viewBox="0 0 448 512">
                        <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" fill="white"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <div id="bg-res-main" class="bg-res-main"></div>
    <main class="main-container">
        <section class="title-section">
            <h1>Administrador de pagos del plan spotify</h1>
            <button id="info-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" fill="#ffffff"/>
                </svg>
            </button>
        </section>
        <section class="main-section">
            <article class="estatus-article-container">
                <h2>Mi estatus</h2>
                <div id="mi-estatus" class="mi-estatus-container"></div>
            </article>
            <article class="integrantes-article-container">
                <h2>Integrantes</h2>
                <div id="integrantes-container" class="integrantes-container"></div>
            </article>
        </section>
    </main>
    <footer class="main-footer-container">
        <div class="main-footer">
            <a href="https://github.com/JesLol" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="15.5" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg></a>
            <p>© 2023 Jesus Cuapio</p>
        </div>
    </footer>
</body>
</html>