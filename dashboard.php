<?php //error_reporting(1); ?>
<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>
  
<?php 


$lowStockSql = "SELECT * FROM product WHERE status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$lowStockSql1 = "SELECT * FROM brands WHERE brand_status = 1";
$lowStockQuery1 = $connect->query($lowStockSql1);
$countLowStock1 = $lowStockQuery1->num_rows;

$date=date('Y-m-d');
    $lowStockSql3 = "SELECT * FROM product WHERE  expdate<'".$date."' AND status = 1";
    //echo "SELECT * FROM product WHERE  expdate<='".$date."' AND status = 1" ;exit;
$lowStockQuery3 = $connect->query($lowStockSql3);
$countLowStock3 = $lowStockQuery3->num_rows;

$lowStockSql2 = "SELECT * FROM orders WHERE delete_status =0";
$lowStockQuery2= $connect->query($lowStockSql2);
$countLowStock2 = $lowStockQuery2->num_rows;

//$connect->close();

// Inicializar el total de ganancias y ventas
$totalProfit = 0;
$totalSales = 0;

// Consulta para obtener el total de ventas y ganancias
$sql = "SELECT SUM(oi.quantity * oi.rate) AS totalSales, 
               SUM(oi.quantity * (oi.rate - p.rate_compra)) AS totalProfit
        FROM order_item oi
        INNER JOIN product p ON oi.productName = p.product_id 
        WHERE oi.lastid IN (SELECT id FROM orders WHERE delete_status = 0)";



if($result = $connect->query($sql)) {
    $row = $result->fetch_assoc();

    $totalSales = $row['totalSales'];
    $totalProfit = $row['totalProfit'];
    $totalSalesPlusProfit = $totalSales + $totalProfit;
} else {
    // Manejo de error de consulta SQL
    echo "Error en la consulta: " . $connect->error;
}
?>
  
<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
        <div class="page-wrapper">
            
        <!--     <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <div class="float-right"><h3 style="color:black;"><p style="color:black;"><?php echo date('l') .' '.date('d').'- '.date('m').'- '.date('Y'); ?></p></h3>
                    </div>
                    </div>
                
            </div> -->
            
            
            <div class="container-fluid ">
                
                 <div class="row">
                <div class="col-md-6 dashboard">

                       <div class="card" style="background: #2BC155 ">
                           <div class="media widget-ten">
                               <div class="media-left meida media-middle">
                                   <span><i class="ti-agenda"></i></span>
                               </div>
                               <div class="media-body media-text-right">
                                
                           
                                   <h2 class="color-white"><?php echo $countLowStock; ?></h2>
                                   <a href="product.php"><p class="m-b-0">Total Medicamentos</p></a>
                               </div>
                           </div>
                       </div>
                       
                   </div> 
                 

                    <div class="col-md-6 dashboard">
                        <div class="card" style="background:#071B32 ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-widget"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                            
                                    <h2 class="color-white"><?php echo $countLowStock1; ?></h2>
                                     <a href="product.php"><p class="m-b-0">Proveedores</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    
          
                   <div class="col-md-6 dashboard">
                      <div class="card " style="    background-color: #F94687 ">
                          <div class="media widget-ten">
                              <div class="media-left meida media-middle">
                                  <span><i class="ti-vector"></i></span>
                              </div>
                              <div class="media-body media-text-right">
                                  
                          <h2 class="color-white"><?php echo $countLowStock2; ?></h2>
                                  <a href="Order.php"><p class="m-b-0">Ventas Totales</p></a>
                              </div>
                          </div>
                      </div>
                  </div>
                        
                  <div class="col-md-6 dashboard">
    <div class="card" style="background-color: #001f3f">
        <div class="media widget-ten">
            <div class="media-left meida media-middle">
                <span><i class="ti-package"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h2 class="color-white"><?php echo number_format($totalSalesPlusProfit, 2); ?></h2>
                <p class="m-b-0">Total Ventas + Ganancias</p>
            </div>
        </div>
    </div>
</div>

                                
                   <div class="col-md-6 dashboard">
                      <div class="card" style="    background-color: #FFBC11 ">
                          <div class="media widget-ten">
                              <div class="media-left meida media-middle">
                                  <span><i class="ti-agenda"></i></span>
                              </div>
                              <div class="media-body media-text-right">
                                  
                          <h2 class="color-white"><?php echo $countLowStock3; ?></h2>
                                  <a href="Order.php"><p class="m-b-0">Medicamentos Expirados</p></a>
                              </div>
                          </div>
                      </div>
                  </div>
                            
                   
                   
                  
     <div class="col-md-12">
<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Ventas Recientes </strong>
                                
                                
                                </div>
                            </div>
                            
                    </div>
                </div>
                </div>
        <div class="row">
            <div class="col-md-6">
                <div id="myChart" style="width:100%; max-width:600px; height:500px;">
                    </div>
            </div>
            <div class="col-md-6">
                
            <div id="myChart1" style="width:100%; max-width:600px; height:500px;"></div>
            </div>
        </div>


<?php
//error_reporting(0);
//require_once('../constant/connect.php');
 $qqq = "SELECT * FROM product WHERE  status ='1' ";
$result=$connect->query($qqq);
//print_r($result);exit;
foreach ($result as $row) {

  //print_r($row);
    $a.=$row["product_name"].',';
    $b.=$row["quantity"].',';
   

 }
    $am= explode(",",$a,-1);
     $amm= explode(",",$b,-1);
     //print_r($a);
     //print_r($b);

  $cnt=count($am);

  $datavalue1='';
                    for($i=0;$i<$cnt;$i++){ 
 $datavalue1.="['".$am[$i]."',".$amm[$i]."],";
         }
          //echo 

 $datavalue1; //used this $data variable in js
?>


                
            </div>
        </div>
    </div>

            
            <?php include ('./constant/layout/footer.php');?>
        <script>
        $(function(){
            $(".preloader").fadeOut();
        })
        </script>
        <script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([ ['Contry', 'Mhl'],<?php echo $datavalue1;?>]);

var options = {
  title:'Stock de productos',
  is3D:true
};

var chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);

  var chart = new google.visualization.BarChart(document.getElementById('myChart1'));
  chart.draw(data, options);
}
</script>