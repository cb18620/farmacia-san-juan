<?php include('./constant/layout/head.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<?php include('./constant/layout/header.php'); ?>

<?php include('./constant/layout/sidebar.php'); ?>
 
<!-- STOCK INCLUIDO -->

<?php include('./constant/connect');

$sql = "SELECT
o.id,
o.uno,
o.orderDate,
o.grandTotalValue,
o.paymentStatus,
GROUP_CONCAT(DISTINCT p.product_name ORDER BY p.product_name SEPARATOR ', ') AS productNames,
GROUP_CONCAT(DISTINCT oi.total ORDER BY oi.total SEPARATOR ', ') AS itemTotals, 
GROUP_CONCAT(p.quantity - IFNULL(oi.quantity, 0) ORDER BY p.product_name SEPARATOR ', ') AS stock_restante
FROM orders o
LEFT JOIN order_item oi ON o.id = oi.lastid
LEFT JOIN product p ON oi.productName = p.product_id
WHERE o.delete_status = 0
GROUP BY o.id
ORDER BY o.id DESC"; // Ordena por fecha de manera ascendente



$result = $connect->query($sql);


?>
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Ventas Actuales</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Ventas</li>
            </ol>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="add-order.php"><button class="btn btn-primary">Nueva Venta</button></a>
                <div class="table-responsive m-t-40">
                    <table id="miTabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Num venta</th>
                                <th>Fecha de Venta</th>
                                <th>Nombre Producto</th>
                                <th>Precio Unitario</th>
                                <th>Total Bs.</th>
                                <th>Stock</th>
                                <th>Estado de Pago</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        </tbody>
                        <?php
                        foreach ($result as $row) {
                            $no+=1;
                        ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?php echo htmlspecialchars($row['uno']); ?></td>
                                <td><?php echo htmlspecialchars($row['orderDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['productNames']); ?></td> <!-- Nombres de productos concatenados -->
                                <td><?php echo htmlspecialchars($row['itemTotals']); ?></td> <!-- Totales de ítems concatenados -->
                                <td><?php echo htmlspecialchars($row['grandTotalValue']); ?></td>
                                <td><?php echo htmlspecialchars($row['stock_restante']); ?></td>
                                <td>
                                    <?php
                                    if($row['paymentStatus'] == 1) {
                                        echo "<label class='label label-success'><h4>PAGADO</h4></label>";
                                    } else if($row['payment_status'] == 2) {
                                        echo "<label class='label label-danger'><h4>Advance Payment</h4></label>";
                                    } else {
                                        echo "<label class='label label-danger'><h4>SIN PAGAR</h4></label>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="editorder.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                    <a href="php_action/removeOrder.php?id=<?php echo $row['id']?>" onclick="return confirm('¿Estás segura de eliminar este registro?')"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></a>
                                    <a href="invoiceprint.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-xs btn-success"><i class="fa fa-print"></i></button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#miTabla').DataTable({
        "paging": true,
        "pageLength": 10,
        "destroy": true,
        "ordering": true,
        "info": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        }
    });
});
</script>

<?php include('./constant/layout/footer.php'); ?>
