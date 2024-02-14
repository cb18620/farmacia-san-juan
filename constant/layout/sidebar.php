<?php 
require_once('./constant/connect.php');
?>

<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Inicio</li>
                <li> <a href="dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i>Panel</a></li>
                
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-industry"></i><span class="hide-menu">Proveedor</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="add-brand.php">Agregar Proveedor</a></li>
                        <li><a href="brand.php">Administrar Proveedor</a></li>
                    </ul>
                </li>
                
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Categorias</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="add-category.php">Agregar Categorias</a></li>
                        <li><a href="categories.php">Administrar Categorias</a></li>
                    </ul>
                </li>
                
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-medkit"></i><span class="hide-menu">Medicamentos</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="add-product.php">Agregar Medicamentos</a></li>
                        <li><a href="product.php">Administrar </a></li>
                    </ul>
                </li>
                
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Ventas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="add-order.php">Nueva Venta</a></li>
                        <li><a href="Order.php">Administrar Ventas</a></li>
                        <li><a href="sales_report.php"> Reporte Ventas</a></li>
                    </ul>
                </li>
                
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-flag"></i><span class="hide-menu">Reportes</span></a>
                    <ul aria-expanded="false" class="collapse">
                        
                        <li><a href="productreport.php">Productos</a></li>
                        <li><a href="expreport.php">Expirados</a></li>
                    </ul>
                </li>
            </ul>   
        </nav>
    </div>
</div>
