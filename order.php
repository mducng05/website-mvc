<?php
include 'inc/header.php';
//include 'inc/slider.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false ) {
    header('location : login.php');
}
?>
    <style>
        .order_pages{
            font-size: 40px;
            font-weight: bold;
            color: grey;
        }
    </style>
    <div class="main">
        <div class="content">
            <div class="cartoption">
                <div class="cartpage">
                    <div class="order_pages">
                        <h3>Order Pages</h3>
                    </div>

                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php
include 'inc/footer.php';
?>