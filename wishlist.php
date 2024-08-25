<?php
include 'inc/header.php';

// Xử lý xóa sản phẩm khỏi danh sách yêu thích
if(isset($_GET['proid'])) {
    $customer_id = Session::get('customer_id');
    $proid = $_GET['proid'];
    $del_wlist = $product->del_wlist($proid, $customer_id);
}

?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Wishlist</h2>
               
                <table class="tblone">
                    <tr>
                        <th width="5%">ID </th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="20%">Hình ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_wishlist = $product->get_wishlist($customer_id);
                    if ($get_wishlist && $get_wishlist->num_rows > 0) { // Kiểm tra xem kết quả truy vấn có dữ liệu hay không
                        $i = 0;
                        while ($result = $get_wishlist->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" width="120px" alt=""/></td>
                                <td><?php echo  $fm->fomat_currency($result['price']) ; ?></td>
                                <td>
                                    <a style="display: inline-block;padding: 5px 10px;background-color: #000;color: #fff;text-decoration: none;border-radius: 4px;" 
                                       href="?proid=<?php echo $result['productId']?>">Remove </a>
                                    <a style="display: inline-block;padding: 5px 10px;background-color: #000;color: #fff;text-decoration: none;border-radius: 4px;" 
                                       href="details.php?proid=<?php echo $result['productId']?>">Buy Now </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Không có sản phẩm trong wishlist</td></tr>";
                    }
                    ?>
                </table>
               
            </div>
            <div class="shopping" >
                <div class="shopleft" style="padding-top: 10px;">
                    <a href="index.php"> <button class="Btn">Continue Shopping</button></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <button class="Btn">Check Out</button></a>
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
