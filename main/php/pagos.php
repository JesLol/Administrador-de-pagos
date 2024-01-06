<?php
header("Content-Type: application/json");
session_start();
if (!isset($_SESSION['aH7rP8sJ3xGvFbK']) && !isset($_SESSION['V6jFpW2qL9aZbR8'])) {
    header("Location: ../../");
    session_destroy();
    die();
}else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $datos = json_decode(file_get_contents('php://input'), true);
        $userType = filter_var($datos['userType'], FILTER_SANITIZE_STRING);
        $username = filter_var($datos['username'], FILTER_SANITIZE_STRING);
        $userID = filter_var($datos['userID'], FILTER_SANITIZE_NUMBER_INT);
        if($userType == "" || $username == "" || $userID == ""){//Si algun dato viene vacio
            http_response_code(400);
            echo json_encode(["mensaje"=>"Datos vacios"]);
        }
        else{
            function pagosQuery($userID){
                include "../../php/conex.php";
                try {
                    $consulta_pago = "SELECT fecha_pago, month, year, pagado FROM pagos WHERE ID_user = :userID";
                    $stmt = $pdo->prepare($consulta_pago);
                    $stmt->bindParam(':userID', $userID);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                        $resultados = $stmt->fetchAll();
                        http_response_code(200);
                        echo json_encode($resultados);
                    }
                    else{
                        include 'crear-reg-pago.php';
                        if(crearRegistro($userID)==true){
                            http_response_code(200);
                            echo json_encode(["mensaje"=>"Registro creado"]);
                        }
                        else{
                            http_response_code(400);
                            echo json_encode(["mensaje" => "Error en la consulta"]);
                        }
                        //Hacer algo
                    }

                    exit;
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["mensaje" => "Error en la consulta"]);
                    exit;
                }
            }
            try {
                include 'verificar-user-act.php';
                $resultadoUsuario = verificarUsuarioActivo($userID, $username);
                if ($resultadoUsuario == 1) {
                    pagosQuery($userID);
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