<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<div class="main">
    <div class="content">
        <div class="content_bottom">
            <div class="heading">
                <h3>All Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $product_new = $product->getproduct_new();
            if ($product_new) {
                while ($result_new = $product_new->fetch_assoc()) {

            ?>
                    <div class="grid_1_of_4 images_1_of_4" style="height: 400px; width:200px;">
                        <a href="details.php?proid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?> " alt="" /></a>
                        <h2><?php echo $result_new['productName'] ?> </h2>
                        <p><?php echo $fm->textShorten($result_new['product_desc'], 70) ?> </p>
                        <p><span class="price"><?php echo $fm->fomat_currency($result_new['price']) . " " . "VNĐ" ?></span></p>
                        <a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">
                            <div class="button"><span>Details
                                </span></div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="trang">
            <?php
            $product_all = $product->get_all_product();
            $product_count = mysqli_num_rows($product_all); // Sử dụng mysqli_num_rows để đếm số dòng trả về bởi truy vấn SELECT
            $product_button = ceil($product_count / 4); // Sử dụng ceil để làm tròn lên số trang
            $i = 0;
            echo '<p>Trang : </p>';
            for ($i = 1; $i <= $product_button; $i++) {
                echo '<a style="margin: 0 5px" href="index.php?Trang=' . $i . '">' . $i . '</a>';
            }
            ?>

        </div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>