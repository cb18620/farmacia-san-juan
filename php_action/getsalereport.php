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
            background-color: #f4f4f4;
            padding-top: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-row {
            margin-bottom: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tfoot tr.total {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            color: #666;
        }
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
   // Inicialización de variables para sumar totales
   $totalDiscount = 0;
   $totalSales = 0;
   $totalPurchaseCost = 0;
   $totalProfit = 0;
   $totalRevenue = 0; // Inicializa la nueva variable para ingresos brutos

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
            echo '<th>Total Sin Descuento</th>';
            echo '<th>Descuento</th>';
            echo '<th>Total Ventas</th>';
            // echo '<th>Suma Ganancias</th>';
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
                echo '<td>'.$row['TotalSinDescuento'].'</td>';
                echo '<td>'.$row['discount'].'</td>';
                echo '<td>'.$row['TotalVentas'].'</td>';
                // echo '<td>'.$row['SumaGanancias'].'</td>';
                echo '<td>'.$row['GananciaNeta'].'</td>';
                echo '</tr>';

                // Sumar los valores para los totales
                $totalDiscount += $row['discount'];
                $totalSales += $row['TotalVentas'];
                // $totalPurchaseCost += $row['SumaGanancias'];
                $totalProfit += $row['GananciaNeta'];
                $totalRevenue += $row['GananciaNeta'] + $row['TotalVentas']; // Suma Ganancia Neta y Total Ventas
            }

            echo '</tbody>';
            // Mostrar los totales al final de la tabla
            echo '<tfoot>';
            echo '<tr class="total">';
            echo '<td colspan="4">Totales</td>';
            echo '<td>' . number_format($totalDiscount, 2) . '</td>';
            echo '<td>' . number_format($totalSales, 2) . '</td>';
            // echo '<td>' . number_format($totalPurchaseCost, 2) . '</td>';
            echo '<td>' . number_format($totalProfit, 2) . '</td>';
            echo '</tr>';
             // Agrega una nueva fila para mostrar el total de ingresos brutos
             echo '<tr class="total-revenue">';
             echo '<td colspan="2">Ingresos Total (Total Ventas + Ganancia)</td>';
             echo '<td>' . number_format($totalRevenue, 2) . '</td>';
             echo '</tr>';
            echo '</tfoot>';
            echo '</table>';
        } else {
            echo '<p>No se encontraron ventas en este rango de fechas.</p>';
        }
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

