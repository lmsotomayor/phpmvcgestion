 
                <script src="../js/jquery-2.2.2.min.js"></script>
                <script src="../js/jquery-ui.1-10.1.js"></script>
                <link rel="stylesheet" href="../js/jquery_css.js" />
             
             
                <link rel="stylesheet" src="../css/bootstrap.css"> 
                <script src="../js/jquery-1.11.2.js"></script>
                
               

 
<?php 
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES') 

  {
    if($_SESSION['nombre']=='administrador'){
    ?>
<?php
define('IN_CB', true);
include('include/header.php');

$default_value['checksum'] = '';
$checksum = isset($_POST['checksum']) ? $_POST['checksum'] : $default_value['checksum'];
registerImageKey('checksum', $checksum);
registerImageKey('code', 'BCGcode39');

$characters = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '-', '.', '&nbsp;', '$', '/', '+', '%');
?>





<?php
include('include/footer.php');
?>
<?php
    }
    else{
      
      header("location: /pantalon/Views/principal.php");
}
  }
  else
  {
    header("location: /pantalon/Views/principal.php");
  }
 ?>

