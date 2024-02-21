<?php require_once 'core.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* ... tus estilos existentes ... */
    </style>
</head>
<body>

<div class="container">
    <h2>Reporte de Ventas</h2>

    <form action="" method="post">
        <div class="form-row">
            <div class="col">
                <input type="date" name="startDate" class="form-control" required>
            </div>
            <div class="col">
                <input type="date" name="endDate" class="form-control" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>
    </form>

    <?php 
       $totalSinDescuentoSum = 0;
       $totalVentasSum = 0;
       $sumaGananciasSum = 0;
       $gananciaNetaSum = 0;
       
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Aquí se debería incluir la lógica de conexión a tu base de datos
        // $connect es tu objeto de conexión mysqli

        $sql = "SELECT
            o.id AS OrderID,
            o.orderDate,
            GROUP_CONCAT(DISTINCT p.product_name ORDER BY p.product_name SEPARATOR ', ') AS ProductsSold,
            GROUP_CONCAT(DISTINCT CONCAT(p.product_name, ' (', oi.quantity, ' x ', p.rate_compra, ')') ORDER BY p.product_name SEPARATOR ', ') AS PurchaseDetails,
            SUM(oi.rate * oi.quantity) AS TotalSinDescuento,
            o.discount,
            o.grandTotalValue AS TotalVentas,
            SUM(oi.quantity * p.rate_compra) AS SumaGanancias,
            (o.grandTotalValue + o.discount) - SUM(oi.quantity * p.rate_compra) AS GananciaNeta
        FROM orders o
        JOIN order_item oi ON o.id = oi.lastid
        JOIN product p ON oi.productName = p.product_id
        WHERE oi.added_date >= '$startDate' AND oi.added_date <= '$endDate'
        GROUP BY o.id
        ORDER BY o.id DESC";

        $result = $connect->query($sql);

        if($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID de Orders</th>';
            echo '<th>Fecha Venta</th>';
            echo '<th>Nombre medicamento</th>';
            echo '<th>Detalles de Compra</th>';
            echo '<th>Total Sin Descuento</th>';
            echo '<th>Descuento</th>';
            echo '<th>Total Ventas</th>';
            echo '<th>Suma Ganancias</th>';
            echo '<th>Ganancia Neta</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Procesar cada fila de resultados
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['OrderID'].'</td>';
                echo '<td>'.$row['orderDate'].'</td>';
                echo '<td>'.$row['ProductsSold'].'</td>';
                echo '<td>'.$row['PurchaseDetails'].'</td>';
                echo '<td>'.$row['TotalSinDescuento'].'</td>';
                echo '<td>'.$row['discount'].'</td>';
                echo '<td>'.$row['TotalVentas'].'</td>';
                echo '<td>'.$row['SumaGanancias'].'</td>';
                echo '<td>'.$row['GananciaNeta'].'</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No se encontraron ventas en este rango de fechas.</p>';
        }
    }
    ?>

    <!-- Código para mostrar el total de ventas en el pie de tabla (footer) -->
    <!-- ... -->

</div>
<div class="footer text-center py-4">
    Reporte generado por Sistema de Ventas
</div>
<!-- Incluir Bootstrap JS y sus dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>