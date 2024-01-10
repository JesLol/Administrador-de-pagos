<?php
header("Content-Type: application/json");
session_start();
if (!isset($_SESSION['aH7rP8sJ3xGvFbK']) && !isset($_SESSION['V6jFpW2qL9aZbR8'])) {
    header("Location: ../../");
    session_destroy();
    die();
}else{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $datos = json_decode(file_get_contents('php://input'), true);
        $username = filter_var($datos['username'], FILTER_SANITIZE_STRING);
        $userID = filter_var($datos['userID'], FILTER_SANITIZE_NUMBER_INT);
        if($username == "" || $userID == ""){//Si algun dato viene vacio
            http_response_code(400);
            echo json_encode(["mensaje"=>"Datos vacios"]);
        }
        else{
            include "../../php/conex.php";
            function obtenerUsuariosActivos() {
                global $pdo;
                try {
                    $consulta = "SELECT username FROM users WHERE activo = 1";
                    $stmt = $pdo->query($consulta);
                    $usuariosActivos = array();
                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $usuariosActivos[] = $fila['username'];
                    }
                    return $usuariosActivos;
                } catch (PDOException $e) {
                    // Manejo de errores
                    return array("error" => "Error del servidor");
                }
            }
            try {
                include 'verificar-user-act.php';
                $resultadoUsuario = verificarUsuarioActivo($userID, $username);
                if ($resultadoUsuario == 1) {
                    //pagosQuery($userID);
                    $resultado = obtenerUsuariosActivos();
                    echo json_encode($resultado);
                } else {
                    http_response_code(400);//aqui esta el error
                    echo json_encode(["mensaje" => "Usuario no encontrado o no activo"]);
                }
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(["mensaje" => "Error de codigo"]);
            }
        }
    }
}
?>