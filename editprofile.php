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
    $id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){	
		$UpdateCustomers = $cs->update_customers($_POST, $id);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="content_top">
    		<div class="heading">
    		<h3>Chỉnh sửa thông tin</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <form action="" method="post">
            <table class="tblone">
                <tr>
                    <td colspan="2">
                        <?php
                            if(isset($UpdateCustomers)){
                                echo '<td colspan="3">'.$UpdateCustomers.'</td>';
                            }
                        ?>
                    </td>
                </tr>
                <?php 
                    $id = Session::get('customer_id');
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){                      
                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                </tr><tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                </tr><tr>
                    <td>Mã vùng</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                </tr><tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                </tr><tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" name="save" value="Cập nhật"></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </form>
 		</div>
 	</div>

</div>
<?php
include 'inc/footer.php';
?>

