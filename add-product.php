<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>
<?php include('./constant/layout/sidebar.php');?>
 

 
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Agregar Medicamento</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar medicina</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div id="add-brand-messages"></div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="row" method="POST"  id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control">
<!-- Agregando los nuevos campos al formulario -->
<div class="form-group col-md-6">
                                                <label class="ontrol-label">Nombre Medicamento</label>
                                                  <input type="text" class="form-control" id="productName" placeholder="Nombre medicamento" name="productName" autocomplete="off" required="" />
                                                </div>
<div class="form-group col-md-6">
        <label class="control-label">Nombre Comercial</label>
        <input type="text" class="form-control" id="nombreComercial" placeholder="Nombre Comercial" name="nombre_comercial" autocomplete="off" required="" />
    </div>
    <div class="form-group col-md-6">
        <label class="control-label">Principio Activo</label>
        <input type="text" class="form-control" id="principioActivo" placeholder="Principio Activo" name="principio_activo" autocomplete="off" required="" />
    </div>
    <div class="form-group col-md-6">
        <label class="control-label">Acción</label>
        <input type="text" class="form-control" id="accion" placeholder="Acción" name="accion" autocomplete="off" required="" />
    </div>

    <!-- ... (resto del código anterior) ... -->
                                        <!-- <div class="form-group col-md-6">
                                                <label class="controFFFFl-label">Imagen Medicamento:</label>
                                                 <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>                         
                                                    <div class="kv-avatar center-block">             
                                                    <input type="file" class="form-control" id="MedicineImage" placeholder="Medicine Name" name="Medicine" class="file-loading" >
                                                </div>
                                            </div> -->

                                           
                                        <div class="form-group col-md-6">
                                                <label class="control-label">cantidad por Unidad</label>
                                                  <input type="text" class="form-control" id="quantity" placeholder="Cantidad" name="quantity" autocomplete="off"  required="" pattern="^[0-9]+$"/>
                                        </div><div class="form-group col-md-6">
                                                <label class="control-label">Precio Compra </label>
                                                   <input type="text" class="form-control" id="rate_compra" placeholder="Precio Compra Bs." name="rate_compra" autocomplete="off" required="" />
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label class="control-label">Precio Comercial</label>
                                                   <input type="text" class="form-control" id="rate" placeholder="Precio Bs." name="rate" autocomplete="off" required="" />
                                        </div>
                                       
                                        <div class="form-group col-md-6">
                                                <label class="control-label">Lote N º</label>
                                                   <input type="text" class="form-control" id="Batch No" placeholder="Lote N º" name="bno" autocomplete="off" required="" pattern="^[Aa-Zz]+$"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label class="control-label">Fecha Expiracion</label>
                                                   <input type="date" class="form-control" id="expdate" placeholder="Fecha Expiracion" name="expdate" autocomplete="off" required="" pattern="^[0-9]+$"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label class="control-label">Nombre Proveedor</label>
                                                  <select class="form-control" id="brandName" name="brandName">
                        <option value="">~~SELECCIONE~~</option>
                        <?php 
                        $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                $result = $connect->query($sql);

                                while($row = $result->fetch_array()) {
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                } // while
                                
                        ?>
                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                           
                                                <label class="control-label">Nombre Categoria</label>
                                                  <select type="text" class="form-control" id="categoryName"  name="categoryName" >
                        <option value="">~~SELECCIONE~~</option>
                        <?php 
                        $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                $result = $connect->query($sql);

                                while($row = $result->fetch_array()) {
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                } // while
                                
                        ?>
                      </select>
                                    </div>
                                        <div class="form-group col-md-6">
                                                <label class="control-label">Estado</label>
                                                     <select class="form-control" id="productStatus" name="productStatus">
                        <option value="">~~SELECCIONE~~</option>
                        <option value="1">Disponible</option>
                        <option value="2">No Disponible</option>
                      </select>
                                        </div>

                                        <div class="col-md-1 mx-auto">
                                        <button type="submit" name="create" id="createProductBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Guardar</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               


 
<?php include('./constant/layout/footer.php');?>
 .


1