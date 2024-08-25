<?php
include 'inc/header.php';

?>
 <div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $product_feathered = $product->getproduct_feathered();
            if($product_feathered){
                while ($result = $product_feathered->fetch_assoc()){

                    ?>
                    <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                        <a href="products.php"><img src="admin/uploads/<?php echo $result['image']?> " alt="" /></a>
                        <h2><?php echo $result['productName']?> </h2>
                        <p><?php echo $fm->textShorten($result['product_desc'] , 70)?> </p>
                        <p><span class="price"><?php echo $fm->fomat_currency($result['price']) ." " ."VNĐ" ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details
                             </a></span></div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>

        <div class="">
            <?php
            $products_all = $product->get_all_products();
            $products_count = mysqli_num_rows($products_all); // Sử dụng mysqli_num_rows để đếm số dòng trả về bởi truy vấn SELECT
            $products_button = ceil($products_count / 4); // Sử dụng ceil để làm tròn lên số trang
            $i = 0;
            echo '<p>Trang : </p>';
            for ($i = 1; $i <= $products_button; $i++) {
                echo '<a style="margin: 0 5px" href="products.php?Trang=' . $i . '">' . $i . '</a>';
            }
            ?>

        </div>
    </div>
 </div>
<?php
include 'inc/footer.php';

?>
