<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

?>
<?php
	$customer_id = Session::get('customer_id');
	if($login_check==false){
		header('Location:login.php');
	}

	$ct = new cart();	
	if(isset($_GET['confirmid'])){
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted_confirm =  $ct->shifted_confirm($id, $time, $price);
	}
?>
 <div class="main">  
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Chi tiết đơn hàng</h2>
			
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="5%">Số lượng</th>								
								<th width="25%">Ngày đặt</th>
                                <th width="25%">Tình trạng</th>
								<th width="10%">Tùy chọn</th>
							</tr>
							<?php
                                $customer_id = Session::get('customer_id');
								$get_cart_ordered = $ct->get_cart_ordered($customer_id);
								if($get_cart_ordered){
									$i = 0;
									$qty = 0;
									while($result = $get_cart_ordered->fetch_assoc()){	
                                        $i++;
							?>
							<tr>
								<td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                                <td><?php echo $result['price'].''.'VNĐ' ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                <td>
									<?php
										if($result['status']=='0'){
											echo 'Đang chờ xử lý...';
										}elseif($result['status']==1){
											?>
											<a href="?confirmid=<?php echo $customer_id ?>&price=
											<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Đã xác nhận...</a>
											<?php
										}else{
											echo 'Đang vận chuyển';
										}
									?>
								</td>
										
                                <td>
									<?php
										if($result['status']=='0'){
											?>
											<td><?php echo 'N/A' ?></td>
											<?php
										}else{
								?>
								</td>
                                <td><a onclick="return confirm('Bạn chắc chắn muốn xóa?');"href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>
								<?php
									}
								?>
							</tr>
								<?php
										}
								}
								?>	
						</table>
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
 <?php
include 'inc/footer.php';
 ?>
 