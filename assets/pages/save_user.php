
<?php
date_default_timezone_set('America/La_Paz');

$current_date = date('Y-m-d');
include('../connect.php');
$passw = hash('sha256', $_POST['password']);
//$passw = hash('sha256',$p);
//echo $passw;exit;
function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$pass = hash('sha256', $salt . $passw);

$image = $_FILES['image']['name'];
$target = "../uploadImage/Profile/".basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
 // @unlink("uploadImage/Profile/".$_POST['old_image']);
      $msg = "Image uploaded successfully";
    }else{
      $msg = "No se pudo cargar la imagen";
    }
extract($_POST);
   $sql = "INSERT INTO admin (username, email,password, fname, lname, gender,  dob,contact,    address,created_on,image,group_id)VALUES ('user', '$email','$pass', '$fname', '$lname', '$gender', '$dob', '$contact', '$address','$current_date','$image','$group_id')";
 if ($conn->query($sql) === TRUE) {
      $_SESSION['success']=' Registro agregado con éxito';
     ?>
<script type="text/javascript">
window.location="../view_user.php";
</script>
<?php
} else {
      $_SESSION['error']='Algo salió mal';
?>
<script type="text/javascript">
window.location="../view_user.php";
</script>
<?php } ?>