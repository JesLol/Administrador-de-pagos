<?php
function verificarUsuarioActivo($userID, $username) {
    include "conex.php";
    try {
        $consulta_username = "SELECT activo FROM users WHERE ID = :userID AND username = :username";
        $stmt = $pdo->prepare($consulta_username);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $resultado = $stmt->fetch();

        return $resultado['activo'];
    } catch (PDOException $e) {
        http_response_code(400);
        echo json_encode(["mensaje" => "Error en la consulta"]);
        exit;
    }
}
?>