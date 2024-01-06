<?php
    header("Content-Type: application/json");
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $datos = json_decode(file_get_contents('php://input'), true);
        $username = filter_var($datos['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($datos['password'], FILTER_SANITIZE_STRING);
        if($username != '' && $password != ''){
            include 'conex.php';
            try{
                $consulta_username = "SELECT * FROM users WHERE username = :username";
                $stmt = $pdo->prepare($consulta_username);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                if ($stmt->rowCount() === 0) {
                    // El username no existe
                    http_response_code(404);
                    echo json_encode(["mensaje" => "Usuario no encontrado"]);
                } else {
                    if($username == "Jesus"){
                        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                        $hash_guardado = $fila['password'];
                        if (password_verify($password, $hash_guardado)) {
                            // La contraseña es correcta
                            session_start();
                            $_SESSION['V6jFpW2qL9aZbR8'] = $username;
                            http_response_code(200);
                            echo json_encode(["mensaje"=>"admin", "psID"=>$fila['ID'], "user"=>$fila['username']]);
                            exit();
                        } else {
                            // La contraseña es incorrecta
                            http_response_code(400);
                            echo json_encode(["mensaje"=>"Contraseña incorrecta"]);
                        }
                    }
                    else{
                        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                        $hash_guardado = $fila['password'];
                        // Verifica la contraseña con password_verify
                        if (password_verify($password, $hash_guardado)) {
                            // La contraseña es correcta
                            session_start();
                            $_SESSION['aH7rP8sJ3xGvFbK'] = $username;
                            http_response_code(200);
                            echo json_encode(["mensaje"=>"sesion iniciada", "psID"=>$fila['ID'], "user"=>$fila['username']]);
                            exit();
                        } else {
                            // La contraseña es incorrecta
                            http_response_code(400);
                            echo json_encode(["mensaje"=>"Contraseña incorrecta"]);
                        } 
                    }
                }
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["mensaje"=>"Error del servidor"]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(["mensaje"=> "Campos vacios"]);
        }
    }
    else{
        http_response_code(401);
        echo json_encode(["mensaje"=> "No permitido"]);
    }
?>
