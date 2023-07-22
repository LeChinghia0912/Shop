<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	 	$login_check = Session::get('customer_login');
		if($login_check==false){
			header('Location:login.php');
		}
	  ?>
<?php
    // if(!isset($_GET['proid']) || $_GET['proid']==NULL){
    //     echo "<script>window.location = '404.php'</script>";
    // }else{
    //     $id = $_GET['proid'];
    // }
	// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
	// 	$quantity = $_POST['quantity'];
	// 	$Addtocart = $ct->add_to_cart($quantity, $id);
	// }
?>
<style>
    h3.payment{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
    }
    .wrapper_method{
        text-align: center; 
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 30px;
        background: cornsilk;
    }
    .wrapper_method a{
        padding: 15px;
        background: red;
        color: #fff;
    }
    .wrapper_method h3{
        margin-bottom: 20px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Thanh toán</h3>
    		</div>
    		<div class="clear"></div>
            <div class="wrapper_method">
                <h3 class="payment">$Phương thức thanh toán</h3><br>
               <a href="offlinepayment.php">Thanh toán khi nhận hàng</a><!--Offline -->
               <a href="">Thanh toán bằng thẻ ATM,Banking...</a><br><br><br><br><!--Online -->
               <a style="background:grey" href="cart.php"> << Quay lại</a>
            </div>
    	</div>
         
 		</div>
 	</div>

</div>
<?php
include 'inc/footer.php';
?>

