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
            function obtenerPagosHistorial($userID){
                try{
                    include '../php/conex.php';
                    $consulta="SELECT month,year,fecha_pago FROM pagos WHERE pagado = 1 AND ID_user = :userID ORDER BY year DESC, month DESC";
                    $stmt = $pdo->prepare($consulta);
                    $stmt->bindParam(':userID', $userID);
                    $stmt->execute();
                    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $resultados;
                }catch(PDOException $e){
                    http_response_code(400);
                    echo json_encode(["mensaje"=>"Error del servidor"]);
                }
            }
            try{
                include '../php/verificar-user-act.php';
                $resultadoUsuario = verificarUsuarioActivo($userID, $username);
                if ($resultadoUsuario == 1) {
                    //pagosQuery($userID);
                    $resultado = obtenerPagosHistorial($userID);
                    echo json_encode($resultado);
                } else {
                    return array("error" => "Error del servidor");
                }
            }catch(Exception $e){
                http_response_code(400);
                echo json_encode(["mensaje"=>"Error del servidor"]);
            }
        }
        else{
            http_response_code(405);
            echo json_encode(["mensaje"=>"No permitido"]);
        }
    }
?>