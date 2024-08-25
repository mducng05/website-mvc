<?php
include 'inc/header.php';
?>


<?php
// Xử lý xóa sản phẩm
////if(isset($_GET['cartid'])) {
////    $cartid = $_GET['cartid'];
////    $delcart = $ct->del_product_cartid($cartid);
////}
////
////// Xử lý cập nhật số lượng sản phẩm
////if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
////    $catId = $_POST['catId'];
////    $quantity = $_POST['quantity'];
////    $update_quantity_cart = $ct->update_quantity_cart($quantity , $catId);
////    if($quantity <= 0){
////        $delcart = $pd->del_product_cartid($cartId);
////    }
////}
////
////// Nếu không có id sản phẩm, chuyển hướng đến trang sản phẩm
////if(!isset($_GET['id'])){
////    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
////}
////?>


<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare Product</h2>
                <?php if(isset($update_quantity_cart)): ?>
                    <?php echo $update_quantity_cart; ?>
                <?php endif; ?>
                <?php if(isset($delcart)): ?>
                    <?php echo $delcart; ?>
                <?php endif; ?>
                <table class="tblone">
                    <tr>
                        <th width="5%">ID Compare</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="20%">Hình ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="20%">Action</th>

                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_compare = $product->get_compare($customer_id);
                    if($get_compare):
                        $i = '0';
                        while ($result = $get_compare->fetch_assoc()):
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" width="120px" alt=""/></td>
                                <td><?php echo $fm->fomat_currency($result['price']) . " VNĐ" ?></td>


                                <td><a style=" display: inline-block;padding: 5px 10px;background-color: #000;color: #fff;text-decoration: none;border-radius: 4px;;"
                                       href="details.php?proid=<?php echo $result['productId']?>">View </a>
                                </td>
                            </tr>
                        <?php

                        endwhile;
                    endif;
                    ?>
                </table>

            </div>
            <div class="shopping" >
                <div class="shopleft" style="padding-top: 10px;">
                    <a href="index.php"> <button class="Btn">Continute<path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
                        </button></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <button class="Btn">Check Out<path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
                        </button></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

<script>
    // JavaScript function to delete cart item without page reload
    function deleteCartItem(cartId) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload(); // Reload page after successful deletion
                }
            };
            xhttp.open("GET", "?cartid=" + cartId, true);
            xhttp.send();
        }
    }
</script>
