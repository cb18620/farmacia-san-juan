<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>
<?php include('./constant/layout/sidebar.php');?>

<?php 
include('./constant/connect');

$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

if($searchTerm) {
    $sql = "SELECT product_id, product_name, product_image, rate, quantity, brand_id, expdate, categories_id, active, status, nombre_comercial, principio_activo, accion FROM product WHERE status = 1 AND (nombre_comercial LIKE '%$searchTerm%' OR product_name LIKE '%$searchTerm%' OR principio_activo LIKE '%$searchTerm%')";
} else {
    $sql = "SELECT product_id, product_name, product_image, rate, rate_compra, quantity, brand_id, expdate, categories_id, active, status, nombre_comercial, principio_activo, accion FROM product WHERE status = 1";
}

$result = $connect->query($sql);
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary"> Ver medicamentos</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Ver medicamentos</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="add-product.php"><button class="btn btn-primary">Agregar Medicament</button></a>

                <!-- Formulario de búsqueda -->
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar por Nombre Comercial, Nombre del Producto o Principio Activo" name="searchTerm">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre </th>
                                <th>Nombre Com.</th>
                                <th>Principio Act.</th>
                                <th>Acción</th>
                                <th>Precio Comercial</th>
                                <th>Precio Compra</th>
                                <th>Cant.</th>
                                <th>Vencimiento</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) {
                                $sql="SELECT * from brands where brand_id='".$row['brand_id']."'";
                                $result1 = $connect->query($sql);
                                $row1=$result1->fetch_assoc();

                                $sql="SELECT * from categories where categories_id='".$row['categories_id']."'";
                                $result2 = $connect->query($sql);
                                $row2=$result2->fetch_assoc();
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $row['product_id'] ?></td>
                                <?php 
                                $d1=date('Y-m-d');
                                if($row['expdate']>=$d1) { ?>
                                    <td><label class="label label-success"><?php echo $row['product_name'];?></label></td> 
                                <?php } else { ?>
                                    <td><label class="label label-danger"><?php echo $row['product_name'];?></label></td>
                                <?php } ?>
                                <td><?php echo $row['nombre_comercial'] ?></td>
                                <td><?php echo $row['principio_activo'] ?></td>
                                <td><?php echo $row['accion'] ?></td>
                                <td><?php echo $row['rate'] ?></td>
                                <td><?php echo $row['rate_compra'] ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo $row['expdate'] ?></td>
                                <td><?php echo $row2['categories_name'] ?></td>
                                <td><?php  
                                if($row['active']==1) {
                                    $activeBrands = "<label class='label label-success'><h4>Disponible</h4></label>";
                                    echo $activeBrands;
                                } else {
                                    $activeBrands = "<label class='label label-danger'><h4>No Disponible</h4></label>";
                                    echo $activeBrands;
                                }?></td>
                                <td>
                                    <a href="editproduct.php?id=<?php echo $row['product_id']?>"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                    <a href="php_action/removeProduct.php?id=<?php echo $row['product_id']?>"><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('¿Estás segura de eliminar este registro?')"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include('./constant/layout/footer.php');?>
