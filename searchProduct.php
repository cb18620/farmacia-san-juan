<?php
require_once 'core.php';

// Obtenemos el término de búsqueda del usuario
$term = $_GET['term'];

// Realizamos una consulta para obtener productos que coincidan con ese término
$sql = "SELECT product_id, product_name, expdate FROM product WHERE product_name LIKE '%$term%' AND active = 1 AND status = 1 AND quantity > 0 LIMIT 10";
$result = $connect->query($sql);

$data = array();

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['product_id'],
            'value' => $row['product_name'] . " - Expira: " . $row['expdate']
        );
    }
}

$connect->close();

// Devolvemos los resultados en formato JSON
echo json_encode($data);
?>
