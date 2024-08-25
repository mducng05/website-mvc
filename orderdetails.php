<?php
include 'inc/header.php';

?>

<?php
// Xử lý xóa sản phẩm
$login_check = Session::get('customer_login');
if($login_check == false){
    header('Location :login.php');
}

$ct = new cart();
if(isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'] ;
    $time = $_GET['time'] ;
    $price = $_GET['price'] ;
    $shifted_confirm = $ct->shifted_confirm($id , $time , $price);
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Details Ordered</h2>

                <table class="tblone">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Product NAme</th>
                        <th width="10%">Image</th>
                        <th width="20%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="10%">Date </th>
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_cart_ordered = $ct->get_cart_ordered($customer_id);
                    if($get_cart_ordered){
                    $i = 0;
                    $qty = 0;
                    while ($result = $get_cart_ordered->fetch_assoc()){
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
                        <td><?php echo $fm->fomat_currency($result['price']) . " VNĐ" ?></td>
                        <td>
                            <?php echo $result['quantity'] ?>
                        </td>
                        <td><?php echo $fm->formatDate($result['date_order'])?>  </td>
                        <td><?php
                            if($result['status']=='0'){
                                echo 'Pending';
                            }elseif ($result['status']=='1'){
                                ?>
                                <span>Shifted</span>
                                <?php
                            }else{
                                echo 'Received' ;
                            }
                            ?>
                        </td>
                        <?php
                        if($result['status']=='0'){
                            ?>
                            <td><?php  echo 'N/A';?></td>

                            <?php
                        }elseif($result['status']=='1'){
                            ?>
                            <td><a href="?confirmid=<?php echo $customer_id?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order']?>">Confirmed</a></td>

                            <?php
                        }elseif($result['status']=='2'){
                            ?>
                            <td><?php echo 'Received'?></td>
                            <?php
                        }
                        ?>

            </div>
            </tr>
            <?php

            }
            }
            ?>
            </table>
        </div>
        <div class="shopping">
            <div class="shopleft" style="padding-top: 10px;">
                <a href="index.php">
                    <button class="Btn">Continute
                        <path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>

<?php include 'inc/footer.php'; ?>
                