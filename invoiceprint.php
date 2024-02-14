<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Impresion detalle</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				    border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				/*border-bottom: 1px solid #eee;*/
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				/*border-top: 2px solid #eee;*/
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>
<?php
     
             require_once('constant/connect.php');
              $sql = "SELECT  * FROM orders WHERE delete_status = 0 and id='".$_GET['id']."' ";
              //echo $sql;exit;
$result = $connect->query($sql);
foreach ($result as $row) { //print_r($row);exit;

             ?>
	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="6">
						<table>
							<tr> 
								<td class="title">
									<img src="https://w7.pngwing.com/pngs/155/90/png-transparent-green-and-white-snake-and-chalice-icon-faculty-of-pharmacy-silpakorn-university-pharmacist-pharmaceutical-drug-naplex-pharmacy-text-logo-grass.png" style="width: 100%; max-width: 300px" />
								</td>

								<td >
									<h1 style="margin:0 0 11px;">Invoice</h1> #:<?php echo $row['uno'] ?><br />
									Created:<?php echo $row['orderDate'] ?><br />
									
								</td>
								
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">

						<table>
							<tr><?php 
							 require_once('constant/connect.php');
								$sql1 = "SELECT email,address,user_id FROM users ";
              //echo $sql;exit;
$result1 = $connect->query($sql1);
//echo $result1;exit;
foreach ($result1 as $row1) {?>
								<td>
									<?php echo $row1['email'] ?><br />
									<?php echo $row1['address'] ?><br />
									
								</td>
<?php } ?>
								<td>
									<?php echo $row['clientName'] ?>
									<br />
									<?php echo $row['clientContact'] ?>
									<br />
									<?php echo $row['address'] ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td colspan="3">Metodo de Pago</td>

					<td colspan="4">Amount</td>
				</tr>

				<tr class="details">
					<td colspan="3"><?php if($row['paymentType']==4){echo "Phone Pe";} if($row['paymentType']==5){echo "Google Pay";} if($row['paymentType']==3){echo "Credit Card";} if($row['paymentType']==2){echo "Cash";} if($row['paymentType']==1){echo "Cheque";}?></td>

					<td colspan="4"><?php echo $row['grandTotalValue'] ?></td>

				</tr>

				<tr class="heading">
					<td>Nombre Medicamento</td>
					<td>lote</td>
					<td>Exp</td>
					<td>Cant.</td>
					<td>MRP</td>
					<td>Precio</td>
					<td>Total</td>

					
				</tr>
<?php 
							 require_once('constant/connect.php');
								$sql2 = "SELECT productName,total,rate,quantity FROM order_item WHERE lastid='".$_GET['id']."' ";
              //echo $sql2;exit;
$result2 = $connect->query($sql2);
//echo $result2;exit;
foreach ($result2 as $row2) { //print_r($row2);exit; ?>
				<tr class="item">
<td><?php
                                                       //echo "SELECT * FROM product WHERE product_id='".$row2['productName']."'";exit;
                     $stmt1 = "SELECT * FROM product WHERE product_id='".$row2['productName']."'";
                     $result2 = $connect->query($stmt1);

                     foreach($result2 as $key1)
                     ?>
                       
                    <?php echo $key1['product_name'];?></td>
					<td><?php echo $key1['bno'] ?></td>
					<td><?php echo $key1['expdate'] ?></td>
					<td><?php echo $row2['quantity'] ?></td>
					<td><?php echo $key1['mrp'] ?></td>
					<td><?php echo $row2['Precio'] ?></td>

					<td><?php echo $row2['total']; ?></td>
				</tr>
				<tr>
					<td rowspan="3" colspan="3" style="border: 1px solid #555">A/C NO:88252565985645 <br>IFSC:MAHB7867
						<br>Nombre Banco: Banco Union</td>
					<td colspan="3"  style="border: 1px solid;text-align: left;">TOTAL Descuento</td>
					<?php

$stmt1 = "SELECT * FROM orders WHERE clientName='".$row['clientName']."'";
                     $cola = $connect->query($stmt1);

                     foreach($cola as $pepsi)
					 ?>
					<td  style="border: 1px solid"><?php echo $pepsi['discount'] ?></td>
				</tr>
				<tr>
					<td colspan="3"  style="border: 1px solid">TOTAL Impuesto</td>
					<td  style="border: 1px solid;text-align: left;"><?php echo $pepsi['gstn'] ?></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid">TOTAL Bs.</td>
					<td style="border: 1px solid;text-align: left;"><?php echo $pepsi['grandTotalValue'] ?></td>
				</tr>
				
<?php $totalAmount += $pepsi['grandTotalValue'];}?>

				<!-- <tr class="item">
					<td>Hosting (3 months)</td>

					<td>$75.00</td>
				</tr>

				<tr class="item last">
					<td>Domain name (1 year)</td>

					<td>$10.00</td>
				</tr>
 -->
				<tr class="total">
					
					
<?php
 
$number = $totalAmount;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array(
    '0' => '',
    '1' => 'Uno',
    '2' => 'Dos',
    '3' => 'Tres',
    '4' => 'Cuatro',
    '5' => 'Cinco',
    '6' => 'Seis',
    '7' => 'Siete',
    '8' => 'Ocho',
    '9' => 'Nueve',
    '10' => 'Diez',
    '11' => 'Once',
    '12' => 'Doce',
    '13' => 'Trece',
    '14' => 'Catorce',
    '15' => 'Quince',
    '16' => 'Dieciséis',
    '17' => 'Diecisiete',
    '18' => 'Dieciocho',
    '19' => 'Diecinueve',
    '20' => 'Veinte',
    '30' => 'Treinta',
    '40' => 'Cuarenta',
    '50' => 'Cincuenta',
    '60' => 'Sesenta',
    '70' => 'Setenta',
    '80' => 'Ochenta',
    '90' => 'Noventa'
);

$digits = array('', 'Cien', 'Mil', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  
 ?> 
 <td>Cantidad:<b><?php echo $result . " 00/100 Bolivianos " . $points;?></b></td>
			<td>Total: <?php echo $totalAmount;?> </td>		
				</tr>
			</table>
		
		</div>
	</body>
	<?php }?>
</html>