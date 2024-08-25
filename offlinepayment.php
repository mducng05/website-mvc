
<?php

session_start();
include 'inc/header.php';
// include 'inc/slider.php'; // Uncomment this line if you have a slider.php file

?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delcart = $ct->del_all_data_cart();
    echo "<script>window.location = 'success.php'</script>";
}
?>

<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Offline Payment </h3>
                </div>
                <div class="clear"></div>
                <table class="merged-table">
                    <tr>
                        <td class="box_left">
                            <div class="cartpage">
                                <?php if(isset($update_quantity_cart)): ?>
                                    <?php echo $update_quantity_cart; ?>
                                <?php endif; ?>
                                <?php if(isset($delcart)): ?>
                                    <?php echo $delcart; ?>
                                <?php endif; ?>
                                <table class="tblone">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="15%">Product Name</th>
                                        <th width="15%">Price</th>
                                        <th width="25%">Quantity</th>
                                        <th width="20%">Total Price</th>
                                    </tr>
                                    <?php
                                    $get_product_cart = $ct->get_product_cart();
                                    if($get_product_cart){
                                        $subtotal = 0;
                                        $qty = 0;
                                        $i = 0;
                                        while ($result = $get_product_cart->fetch_assoc()){
                                            $i++ ;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['productName'] ?></td>
                                                <td><?php echo $fm->fomat_currency($result['price']) . " VNĐ" ?></td>
                                                <td><?php echo $result['quantity'] ?></td>
                                                <td>
                                                    <?php
                                                    $total = $result['price'] * $result['quantity'];
                                                    echo $fm->fomat_currency($total).' '.'VNĐ';
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $subtotal += $total;
                                            $qty += $result['quantity'];
                                        }
                                    }
                                    ?>
                                </table>
                                <table style="float:right ; text-align:left ; margin:5px" width="40%">
                                    <tr>
                                        <th>Sub Total : </th>
                                        <td>
                                            <?php
                                            $qty = $qty + $result['quantity'];
                                            echo $fm->fomat_currency($subtotal).' '.'VNĐ';
                                            Session::set('sum' , $subtotal);
                                            Session::set('qty' , $qty);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>VAT : </th>
                                        <td>10% (<?php echo $fm->fomat_currency($vat = $subtotal * 0.1).' '.'VNĐ'; ?>)</td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total :</th>
                                        <td><?php
                                            $vat = $subtotal * 0.1 ;
                                            $gtotal = $subtotal + $vat;
                                            echo $fm->fomat_currency($gtotal).''.'VNĐ';
                                            ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td class="box_right">
                            <table class="tblone" >
                                <?php
                                $id = Session::get('customer_id');
                                $get_customers = $cs->show_customers($id);
                                if($get_customers){
                                    while ($result = $get_customers->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td><?php echo $result['name'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>City</td>
                                            <td>:</td>
                                            <td><?php echo $result['city'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td><?php echo $result['phone'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>Zipcode</td>
                                            <td>:</td>
                                            <td><?php echo $result['zipcode'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?php echo $result['email'] ?></td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td><?php echo $result['address'] ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

        </div >
        <center><a href="?orderid=order" class="a_order" >Order </a></center><br>
    </div>
</form>

<?php
include 'inc/footer.php';
?>