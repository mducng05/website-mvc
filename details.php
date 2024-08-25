<?php
include 'inc/header.php';
// include 'inc/slider.php'; // Uncomment this line if you have a slider.php file

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
   echo "<script>window.location = '404.php' </script>";
} else {
    $id = $_GET['proid'];
}
$customer_id = Session::get('customer_id');
if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['compare'])){

    $productId = $_POST['productId'];
    $insertCompare = $product -> insertCompare($productId, $customer_id);
}

if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['wishlist'])){

    $productId = $_POST['productId'];
    $insertWishlist = $product -> insertWishlist($productId, $customer_id);
}

// Assuming you have a Cart class and Product class defined
$ct = new Cart();
$product = new Product();
$cat = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $ct->add_to_cart($quantity, $id);
    echo "<script>window.location = 'cart.php' </script>";
}

if(isset($_POST['binhluan_submit'])){
    $binhluan_insert = $cs->insert_binhluan();
}

?>

    <div class="main">
        <div class="content">
            <div class="section group">
                <?php
                $get_product_details = $product->get_details($id);
                if ($get_product_details) {
                    while ($result_details = $get_product_details->fetch_assoc()) {
                        ?>
                        <div class="cont-desc span_1_of_2">
                            <div class="grid images_3_of_2">
                                <img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
                            </div>
                            <div class="desc span_3_of_2">
                                <h2><?php echo $result_details['productName'] ?> </h2>
<!--                                <p>--><?php //echo $result_details['product_desc'] ?><!--</p>-->
                                <div class="price">
                                    <p>Price: <span><?php echo $fm->fomat_currency($result_details['price']) . " VNĐ" ?></span></p>
                                    <p>Category: <span><?php echo $result_details['catName'] ?></span></p>
                                    <p>Brand: <span><?php echo $result_details['brandName'] ?></span></p>
                                </div>
                                <div class="add-cart">
                                    <form action="" method="post">
                                        <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
                                        <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                    </form>

                                </div>

                                <div class="add-cart">
                                    <div class="buttom_details">
                                        <form action ="" method = "POST">
                                            <input type="hidden"  name="productId" value="<?php echo $result_details['productId'] ?>"/>

                                            <?php
                                            $login_check = Session::get('customer_login');
                                            if($login_check){
                                                echo '<input type="submit"  class="buysubmit" name="compare" value="Compare Product"/>'.'  ';

                                            }else{
                                                echo '';
                                            }
                                            ?>

                                            <?php
                                            if(isset($insertCompare)){
                                                echo $insertCompare;
                                            }
                                            ?>
                                        </form>


                                        <form action ="" method = "POST">
                                            <input type="hidden"  name="productId" value="<?php echo $result_details['productId'] ?>"/>

                                            <?php
                                            $login_check = Session::get('customer_login');
                                            if($login_check){
                                                echo '<input type="submit"  class="buysubmit" name="wishlist" value="Save to wishlist"/>';
                                            }else{
                                                echo '';
                                            }
                                            ?>

                                            <?php
                                            if(isset($insertWishlist)){
                                                echo $insertWishlist;
                                            }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="product-desc">
                                <h2>Product Details</h2>
                                <?php echo $result_details['product_desc'] ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="rightsidebar span_3_of_1">
                    <h2>CATEGORIES</h2>
                    <ul>
                        <?php
                        $getall_category = $cat->show_category();
                        if ($getall_category) {
                            while ($result_all = $getall_category->fetch_assoc()) {
                                ?>
                                <li><a href="productbycat.php?catId=<?php echo $result_all['catId'] ?>"><?php echo $result_all['catName'] ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="binhluan">
        <div class="row">

            <div class="col-md-8">
                <h5>Bình luận sản phẩm</h5>
<!--                <ul>-->
<!--                --><?php
//                    for($count = 1; $count <=5 ; $count++){
//                        if($count <=4){
//                            $color = 'color:#ffcc00;'; //màu xám vàng
//                        }
//                        else {
//                            $color = 'color:#ccc;'; // màu xám
//                        }
//                ?>
<!--                <li class="rating" style="cursor: pointer;font-size:30px; "  --><?php //echo $color ?><!--
                    &#9733;-->
<!--                </li>-->
<!--                --><?php
//                    }
//                ?>
<!--                </ul>-->

                <?php
                    if(isset($binhluan_insert)){
                        echo $binhluan_insert         ;
                    }
                ?>
                <form action="" method="post">
                    <p><input type="hidden" value="<?php echo $id ?>" name="product_id_binhluan"></p>
                    <p><input type="text" class="form-control" name="tennguoibinhluan" placeholder="Điền Tên..."></p>
                    <p><textarea rows="5" style="resize: none;" class="form-control" name="binhluan" placeholder="Bình Luận..."></textarea></p>
                    <p><input type="submit" name="binhluan_submit" class="btb btn-success" value="Gửi Bình Luận" ></p>
                </form>
            </div>
        </div>
            </textarea></p>
        </div>
    </div>
<?php
include 'inc/footer.php';
?>