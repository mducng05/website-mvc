<div class="home">
    <div class="max-width" style="width:10000px;">
    </div>
</div>
<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $getLastesIphone = $product->getLastesIphone();
            if ($getLastesIphone) {
                while ($reulstiphone = $getLastesIphone->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $reulstiphone['productId'] ?>"> <img
                                    src="admin/uploads/<?php echo $reulstiphone['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>DELL</h2>
                            <p><?php echo $reulstiphone['productName'] ?></p>
                            <a href="details.php?proid=<?php echo $reulstiphone['productId'] ?>">
                                <div class="button"><span>Add to cart</span></div>
                            </a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $getLastesSS = $product->getLastesSamsung();
            if ($getLastesSS) {
                while ($reulstss = $getLastesSS->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $reulstss['productId'] ?>"><img
                                    src="admin/uploads/<?php echo $reulstss['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Samsung</h2>
                            <p><?php echo $reulstss['productName'] ?></p>
                            <a href="details.php?proid=<?php echo $reulstss['productId'] ?>">
                                <div class="button"><span>Add to cart</span></div>
                            </a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="section group">
            <?php
            $getLastesOp = $product->getLastesOppo();
            if ($getLastesOp) {
                while ($reulstop = $getLastesOp->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $reulstop['productId'] ?>"><img
                                    src="admin/uploads/<?php echo $reulstop['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Oppo</h2>
                            <p><?php echo $reulstop['productName'] ?></p>
                            <a href="details.php?proid=<?php echo $reulstop['productId'] ?>">
                                <div class="button"><span>Add to cart</span></div>
                            </a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $getLastesHw = $product->getLastesHuawei();
            if ($getLastesHw) {
                while ($reulsthw = $getLastesHw->fetch_assoc()) {
            ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?proid=<?php echo $reulsthw['productId'] ?>"><img
                                    src="admin/uploads/<?php echo $reulsthw['image'] ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Huawei</h2>
                            <p><?php echo $reulsthw['productName'] ?></p>
                            <a href="details.php?proid=<?php echo $reulsthw['productId'] ?>">
                                <div class="button"><span>Add to cart</span></div>
                            </a>
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
                    <?php
                    $get_slider = $product->show_slider();
                    if ($get_slider) {
                        while ($result_slider = $get_slider->fetch_assoc()) {
                    ?>
                            <li><img src="admin/<?php echo $result_slider['slider_image'] ?>"
                                    alt="<?php echo $result_slider['sliderName'] ?>" /></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>