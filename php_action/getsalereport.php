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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            background-color: #ddd;
        }
        
    .color-venta-1 { 
        background-color: #FFCCCC;
     } 

    .color-venta-2 {
         background-color: #CCCCFF;
     }
    </style>
</head>
<body>

<div class="container">
    <h2>Reporte de Ventas</h2>

    <?php 
    if($_POST) {

        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $sql = "SELECT oi.*, p.product_name, p.rate_compra FROM order_item oi 
                INNER JOIN product p ON oi.productName = p.product_id 
                WHERE oi.added_date >= '$startDate' AND oi.added_date <= '$endDate'";
        $query = $connect->query($sql);

        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nombre medicamento</th>';
        echo '<th>Cantidad</th>';
        echo '<th>Total</th>';
        echo '<th>Ganancia</th>';
        echo '<th>Nº Venta</th>';
        echo '<th>Fecha Venta</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $totalAmount = 0;
        $totalProfit = 0;
        $currentSaleNumber = null;
        $isOddSale = true;
        $lastSaleNumber = ""; // Variable para mantener el número de la última venta
        $colorClass = "color-venta-1"; // Clase de color inicial
        
        while ($result = $query->fetch_assoc()) {

            $quantity = floatval($result['quantity']);
            $rate = floatval($result['rate']);
            $rate_compra = floatval($result['rate_compra']);
            $total = $rate * $quantity;
            $profit = ($rate - $rate_compra) * $quantity;

            if ($lastSaleNumber !== $result['lastid']) {
                // Cambia el color de fondo para el nuevo número de venta
                $colorClass = ($colorClass === "color-venta-1") ? "color-venta-2" : "color-venta-1";
                $lastSaleNumber = $result['lastid']; // Actualizar el último número de venta
            }
          
            echo '<tr class="' . $colorClass . '">';
            echo '<td>'.$result['product_name'].'</td>';
            echo '<td>'.$quantity.'</td>';
            echo '<td>'.number_format($total, 2).'</td>';
            echo '<td>'.number_format($profit, 2).'</td>';
            echo '<td>'.$result['lastid'].'</td>';
            echo '<td>'.$result['added_date'].'</td>';
            echo '</tr>';    

            $totalAmount += $total;
            $totalProfit += $profit;
        }

        $totalSalesPlusProfit = $totalAmount + $totalProfit;

        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr class="total">';
        echo '<th colspan="2">Total Ventas</th>';
        echo '<th>'.number_format($totalAmount, 2).'</th>';
        echo '<th>Total Ganancias</th>';
        echo '<th>'.number_format($totalProfit, 2).'</th>';
        echo '<th></th>';
        echo '</tr>';
        echo '<tr class="total">';
        echo '<th colspan="3">Total Ventas + Ganancias</th>';
        echo '<th>'.number_format($totalSalesPlusProfit, 2).'</th>';
        echo '<th colspan="2"></th>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
    }
    ?>

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
