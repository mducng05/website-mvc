<?php
include 'inc/header.php';
// include 'inc/slider.php'; // Uncomment this line if you have a slider.php file
?>

<?php
$login_check = Session::get('customer_login');
if($login_check == false){
    header('Location : login.php');
}
?>
<style>

    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        
    }

    .content {
        max-width: 600px;
        padding: 20px;
    }
 

    .main {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

        </style>
        <div class="main">
            <div class="content">
                <div class="section group">
                    <div class="content_top">
                        <div class="heading">
                            <h3>Payment Method </h3>
                        </div>
                        <div class="clear"></div>
                        <div class="wrapper_method">
                            <h3 class="payment">Choose your method payment</h3>
                            <p class="hrel"><a href="offlinepayment.php">Offline Payment</a></p>
                            <p class="hrel"><a href="donhangthanhtoanonline.php">Online Payment</a></p>
                            <a href="cart.php"><< Previous</a>
                        </div>
                        </div>
                </div>
            </div>
        </div>
<?php
include 'inc/footer.php';
?>