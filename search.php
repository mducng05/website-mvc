<?php
include 'inc/header.php';
?>

<div class="main">
    <div class="content">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
        $tukhoa = htmlspecialchars(trim($_POST['tukhoa']));
        
        if (isset($product) && method_exists($product, 'search_product')) {
            $search_product = $product->search_product($tukhoa);
        } else {
            $search_product = false;
            echo 'Có lỗi xảy ra khi tìm kiếm sản phẩm.';
        }
    } else {
        $tukhoa = '';
        $search_product = false;
    }
    ?>
    <div class="content_top">
        <div class="heading">
            <h3>Từ khóa tìm kiếm: <?php echo $tukhoa ?></h3>
        </div>
        <div class="clear"></div>
    </div>
    <div class="section group">
        <?php
        if ($search_product) {
            while ($result = $search_product->fetch_assoc()) {
        ?>
                <div class="grid_1_of_4 images_1_of_4" style="height: 400px">
                    <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" /></a>
                    <h2><?php echo $result['productName'] ?> </h2>
                    <p><?php echo $fm->textShorten($result['product_desc'], 70); ?> </p>
                    <p><span class="price"><?php echo $fm->fomat_currency($result['price']) . ' ' . 'VNĐ'; ?></span></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
                </div>
        <?php
            }
        } else {
            echo 'Không tìm thấy sản phẩm nào.';
        }
        ?>
    </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>
