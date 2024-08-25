<?php
include 'inc/header.php';

?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Oppo</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <div class="section group">
            <?php
            $getLastesop = $product->LastesOp();
            if ($getLastesop) {
                while ($reulstop = $getLastesop->fetch_assoc()) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                        <a href="details.php"><img src="admin/uploads/<?php echo $reulstop['image']?> " alt="" /></a>
                        <h2><?php echo $reulstop['productName']?> </h2>
                        <p><?php echo $fm->textShorten($reulstop['product_desc'] , 70)?> </p>
                        <p><span class="price"><?php echo $fm->fomat_currency($reulstop['price'])." " ."VNĐ" ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $reulstop['productId']?>" class="details">Details
                                </a></span></div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="content_top">
                <div class="heading">
                    <h3>Samsung</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
            <?php
            $getLastesSamsung = $product->getLastesSS();
            if ($getLastesSamsung) {
                while ($reulstSS = $getLastesSamsung->fetch_assoc()) {
            ?>
                    <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                        <a href="details.php"><img src="admin/uploads/<?php echo $reulstSS['image']?> " alt="" /></a>
                        <h2><?php echo $reulstSS['productName']?> </h2>
                        <p><?php echo $fm->textShorten($reulstSS['product_desc'] , 60)?> </p>
                        <p><span class="price"><?php echo $fm->fomat_currency($reulstSS['price'])." " ."VNĐ" ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $reulstSS['productId']?>" class="details">Details
                                </a></span></div>
                    </div>
                    <?php
                }
            }
            ?>
            </div>

            <div class="content_top">
                <div class="heading">
                    <h3>Iphone</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <?php
                $getLastesIp = $product->getLastesIp();
                if ($getLastesIp) {
                    while ($reulstIp = $getLastesIp->fetch_assoc()) {
                        ?>
                        <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                            <a href="details.php"><img src="admin/uploads/<?php echo $reulstIp['image']?> " alt="" /></a>
                            <h2><?php echo $reulstIp['productName']?> </h2>
                            <p><?php echo $fm->textShorten($reulstIp['product_desc'] , 60)?> </p>
                            <p><span class="price"><?php echo $fm->fomat_currency($reulstIp['price'])." " ."VNĐ" ?></span></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $reulstIp['productId']?>" class="details">Details
                                </a></span></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="content_top">
                <div class="heading">
                    <h3>Huawei</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <?php
                $getLasteshw = $product->getLastesHW();
                if ($getLasteshw) {
                    while ($reulstHW = $getLasteshw->fetch_assoc()) {
                        ?>
                        <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                            <a href="details.php"><img src="admin/uploads/<?php echo $reulstHW['image']?> " alt="" /></a>
                            <h2><?php echo $reulstHW['productName']?> </h2>
                            <p><?php echo $fm->textShorten($reulstHW['product_desc'] , 60)?> </p>
                            <p><span class="price"><?php echo $fm->fomat_currency($reulstHW['price'])." " ."VNĐ" ?></span></p>
                            <div class="button"><span><a href="details.php?proid=<?php echo $reulstHW['productId']?>" class="details">Details
                                </a></span></div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
 </div>
<?php
      include 'inc/footer.php';
?>
