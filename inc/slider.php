<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastesDell = $product->getLastesDell();
					if($getLastesDell){
						while($resultdell = $getLastesDell->fetch_assoc()){				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultdell['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?php echo $resultdell['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId']?>">Thêm</a></span></div>
				   </div>
			   </div>	
			   <?php
			   		}
				}
			   ?>
			   <?php
					$getLastesSS = $product->getLastesSamsung();
					if($getLastesSS){
						while($resultss = $getLastesSS->fetch_assoc()){				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="admin/uploads/<?php echo $resultss['image']?>" alt=""></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $resultss['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultss['productId']?>">Thêm</a></span></div>
					</div>
				</div>
				<?php
			   		}
				}
			   ?>
			</div>
			<div class="section group">
			<?php
					$getLastesIP = $product->getLastesIphone();
					if($getLastesIP){
						while($resultip = $getLastesIP->fetch_assoc()){				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultip['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $resultip['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultip['productId']?>">Thêm</a></span></div>
				   </div>
			   </div>	
			   <?php
						}
					}
			   ?>
			   <?php
					$getLastesOP = $product->getLastesOppo();
					if($getLastesOP){
						while($resultop = $getLastesOP->fetch_assoc()){				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="admin/uploads/<?php echo $resultop['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>OPPO</h2>
						  <p><?php echo $resultop['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultop['productId']?>">Thêm</a></span></div>
					</div>
				</div>
				<?php
						}
					}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>