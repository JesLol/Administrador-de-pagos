<?php
function crearRegistro($userID){
    include "../../php/conex.php";
    date_default_timezone_set('America/Mexico_City');
    $fecha_actual = new DateTime();
    $fecha_m = $fecha_actual->format('m');
    $fecha_y = $fecha_actual->format('Y');
    $fecha_completa = $fecha_y."-".$fecha_m."-05";
    $pagado = 0;
    try {
        $consulta = "INSERT INTO pagos (ID_user, fecha_pago, month, year, pagado) VALUES (:userID, :fecha_pago, :month, :year, :pagado)";
        $stmt = $pdo->prepare($consulta);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':fecha_pago', $fecha_completa);
        $stmt->bindParam(':month', $fecha_m);
        $stmt->bindParam(':year', $fecha_y);
        $stmt->bindParam(':pagado', $pagado);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
?>