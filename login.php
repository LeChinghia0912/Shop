<?php
include 'inc/header.php';
?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:order.php');
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){	
		$insertCustomer = $cs->insert_customer($_POST);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){	
		$login_Customer = $cs->login_customer($_POST);
	}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Đăng Nhập Khách Hàng</h3>
			<?php 
				if(isset($login_Customer)){
					echo $login_Customer;
				}
			?>
        	<form action="" method="POST" id="member">
                	<input  type="text" name="email" class="field" placeholder="Email....">
                    <input  type="password" name="password" class="field" placeholder="Password...">
                 
                 <p class="note">Bạn quên Email hoặc mật khẩu ấn vào đây-><a href="#">Quên Thông Tin Tài Khoản</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng Nhập"></div></div>
					</form>
                    </div>
					<?php
						
					?>
    	<div class="register_account">
    		<h3>Đăng kí thành viên mới</h3>
			<?php 
				if(isset($insertCustomer)){
					echo $insertCustomer; 
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên...">
							</div>
							
							<div>
							   <input type="text" name="city"  placeholder="Nhập thành phố...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập mã vùng...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập E-Mail...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Nhập địa chỉ...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Tỉnh</option>         
							<option value="na">Nghệ AN</option>
							<option value="hn">Hà Nội</option>
							<option value="hcm">TP.HCM</option>
							<option value="dn">Đà Nẵng</option>
							<option value="vi">Vinh</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Nhập số điện thoại...">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Nhập mật khẩu ...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Đăng Ký"></div></div>
		    <input type="checkbox" class="terms">Bạn đồng ý với các điều khoản và dịch vụ <a href="#">Điều khoản &amp; dịch vụ</a>.</input>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php
include 'inc/footer.php';

?>
