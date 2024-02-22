<?php
require_once 'core.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

if (isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Preparar la consulta para obtener los detalles de la venta y el stock actual
    $sql = "SELECT p.product_name, oi.quantity AS sold_quantity, oi.rate, p.quantity AS current_stock 
            FROM order_item oi 
            INNER JOIN product p ON oi.productName = p.product_id 
            WHERE oi.lastid = ?";
            
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table class='table'>";
    echo "<thead><tr><th>Medicamento</th>
    <th>Cantidad Vendida</th>
    <th>Stock Actual</th>
    <th>Precio de Venta</th>   
    </tr></thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row['product_name']."</td>
        <td>".$row['sold_quantity']."</td>
        <td>".$row['current_stock']."</td>
        <td>".$row['rate']."</td>
        
        </tr>";
    }

    echo "</tbody></table>";
}
?>
