<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customer_id = Session::get('customer_id');
		$insertOrder = $ct->insertOrder($customer_id);
		$delCart = $ct->dell_all_data_cart();
		header('Location:success.php');
    }
	// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
	// 	$quantity = $_POST['quantity'];
	// 	$Addtocart = $ct->add_to_cart($quantity, $id);
	// }
?>
<style type="text/css">
    .box_left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }
    .box_right{
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
   .submit_order{
        padding: 10px 70px;
        border: none;
        background: red;
        font-size: 25px;
        color: #fff;
        margin: 10px;
        cursor: pointer;
		
    }
	.a_order{
		padding: 10px 20px;
		background: red;
		color: #fff;
		font-size: 21px;
	}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="heading">
    		<h3>Thanh toán khi nhận hàng</h3>
    		</div>
            <div class="clear"></div>
            <div class="box_left">
            <div class="cartpage">

					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Product Name</th>	
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
                                    $i = 0;
									while($result = $get_product_cart->fetch_assoc()){	
                                        $i++;
							?>
							<tr>
                                <td><?php echo $i?></td>
								<td><?php echo $result['productName']?></td>
								<td><?php echo $result['price'].' '.' VNĐ'?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php 
									$total = $result['price'] * $result['quantity'];
									echo $total.' '.' VNĐ'; 
								?></td>
								
							</tr>
								<?php
								$subtotal += $total;
								$qty = $qty + $result['quantity'];
								}
							}
								?>
						</table>
						<?php
										$check_cart = $ct->check_cart();
										if($check_cart){

										?>
						<table style="float:right;text-align:left;margin:5px" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php 
									
									echo $subtotal.' '.' VNĐ';
									Session::set('sum',$subtotal);
									Session::set('qty',$qty);
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%(<?php echo $vat = $subtotal * 0.1; ?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php 
									$vat = $subtotal * 0.1;
									$gtotal = $subtotal + $vat;
									echo $gtotal.' '.' VNĐ';
								?> </td>
							</tr>
					   </table>
					   <?php 
							}else{
								echo 'Giỏ hàng của bạn trống ! hãy thực hiện mua hàng.';
							}
					   ?>
					</div>
            </div>
            <div class="box_right">
            <table class="tblone">
                <?php 
                    $id = Session::get('customer_id');
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){                      
                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr><tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr><tr>
                    <td>Mã vùng</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr><tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr><tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Sửa thông tin khách hàng</a></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
            </div>
            
 		</div>
        
 	</div>
     <center><a href="?orderid=order" class="a_order">Đặt Hàng</a></center><br>           
</div>
</form>
<?php
include 'inc/footer.php';

?>

