<?php
include 'inc/header.php';
// include 'inc/slider.php'; // Uncomment this line if you have a slider.php file

?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delcart = $ct->del_all_data_cart();
    header('Location : success.php');
}
?>

    <form action="" method="post">
        <div class="main">
            <div class="content">
                <div class="section group">
                    <h2 class="success_order">Success Order</h2>
                    <?php
                        $customer_id = Session::get('customer_id');
                        $get_amount = $ct->getAmountPrice($customer_id);
                        if($get_amount){
                            $amount = 0;
                        while($result = $get_amount->fetch_assoc()){
                                $price = $result['price'];
                                $amount += $price; 
                            }
                        }
                    ?>
                    <p class="success_note"><br>Tổng tiền đã mua : <?php $fm->fomat_currency($total = $amount *0.1); echo $fm->fomat_currency($total);?></br> </p>
                    <p class="success_note"><br><br>Chúng tôi sẽ liên sớm nhất có thể. Vui lòng xem lại ở đây <a href="orderdetails.php"> Xem lại</a></br></p>

                </div>
            </div>
        </div>
    </form>
<?php
include 'inc/footer.php';
?>

