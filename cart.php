<?php
include 'inc/header.php';

// Xử lý xóa sản phẩm
if(isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cartid($cartid);
}

// Xử lý cập nhật số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity , $cartId);
    if($quantity <= 0){
        $delcart = $pd->del_product_cartid($cartId);
    }
}

// Nếu không có id sản phẩm, chuyển hướng đến trang sản phẩm
if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>


<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php if(isset($update_quantity_cart)): ?>
                    <?php echo $update_quantity_cart; ?>
                <?php endif; ?>
                <?php if(isset($delcart)): ?>
                    <?php echo $delcart; ?>
                <?php endif; ?>
                <table class="tblone">
                    <tr>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Hình ảnh</th>
                        <th width="10%">Giá</th>
                        <th width="25%">Số lượng</th>
                        <th width="20%">Tổng giá</th>
                        <th width="15%">Thao tác</th>
                    </tr>
                    <?php
                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart):
                        $subtotal = 0;
                        $qty = 0;
                        while ($result = $get_product_cart->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                                <td><?php echo $fm->fomat_currency($result['price'])." " ."VNĐ" ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
                                        <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $fm->fomat_currency($total)." " ."VNĐ";
                                    ?>
                                </td>
                                <td><div class="custom-button" onclick="deleteCartItem(<?php echo $result['cartId']; ?>)">
                                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $subtotal += $total;
                            $qty += $result['quantity'];
                        endwhile;
                    endif;
                    ?>
                </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Tổng tiền : </th>
                        <td>
                            <?php
                            $qty = $qty + $result['quantity'];
                            echo $fm->fomat_currency($subtotal)." " ."VNĐ";
                            Session::set('sum' , $subtotal);
                            Session::set('qty' , $qty);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <th>Tổng cộng :</th>

                        <td>
                            <?php
                            $vat = $subtotal * 0.1;
                            $gtotal = $subtotal + $vat ;
                            echo $fm->fomat_currency($gtotal)." "."VNĐ" ;
                            ?>
                        </td>
                    </tr>
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
