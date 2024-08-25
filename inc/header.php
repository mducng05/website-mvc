<?php
ob_get_contents()
?>
<?php
include 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cs = new customer();
$cat = new category();
$product = new product();
?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

//    header("Cache-Control: no-cache, must-revalidate, max-age=0");
//    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!--     <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/> -->
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
    <script>
        function changeInputStyle() {
            var input = document.getElementById('searchInput');
            input.style.backgroundColor = 'white';
            input.style.color = 'black';
            input.focus();
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="wrap">
            <div class="header_top">
                <div class="container" style="display: flex;justify-content: space-between;align-items: center; background-color:black;">
                    <div class="header_top_right">
                        <div class="search_box">
                            <form action="search.php" method="post">
                                <input id="searchInput" type="text" name="tukhoa" placeholder="search product" style="color:white;">
                                <button type="submit" name="search_product" style="color:white;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="logo">
                        <a href="index.php"><img src="images/logoDNH.jpg" alt="" /></a>
                    </div>
                    <div class="header_top_right">
                        <div class="shopping_cart">
                            <div class="cart">
                                <a href="cart.php" title="View my shopping cart" rel="nofollow">
                                    <i class="fas fa-shopping-cart" style="color: white;"></i>
                                    <span class="cart_title"></span>
                                    <span class="no_product">
                                        <?php
                                        $check_cart = $ct->check_cart();
                                        if ($check_cart) {
                                            $sum = Session::get("sum");
                                            $qty = Session::get("qty");
                                            echo $sum . ' ' . 'đ' . ' ' . 'Qty:' . $qty;
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <?php
                        if (isset($_GET['customer_id'])) {
                            $delCart = $ct->del_all_data_cart();
                            Session::destroy();
                        }
                        ?>
                        <div class="login">
                            <?php
                            $login_check = Session::get('customer_login');
                            if ($login_check == false) {
                                echo '<a href="login.php"><i class="fas fa-sign-in-alt" style="color: white;"></i> </a></div>';
                            } else {
                                echo '<a href="?customer_id=' . Session::get('customer_id') . '"><i class="fas fa-sign-out-alt" style="color: white;"></i> Logout</a></div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="menu">
                    <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">Products</a> </li>
                        <li><a href="topbrands.php">Top Brands</a></li>

                        <?php
                        $check_cart = $ct->check_cart();
                        if ($check_cart == true) {
                            echo '<li><a href="cart.php">Cart</a></li>';
                        } else {
                            echo '';
                        }
                        ?>

                        <?php
                        $customer_id = Session::get('customer_id');
                        $check_order = $ct->check_order($customer_id);
                        if ($check_order == true) {
                            echo '<li><a href="orderdetails.php">Ordered</a></li>';
                        } else {
                            echo '';
                        }
                        ?>

                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false) {
                            echo '';
                        } else {
                            echo '<li><a href="profile.php">Profile</a></li>';
                        }
                        ?>

                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check) {
                            echo '<li><a href="compare.php">Compare</a></li>';
                        }
                        ?>

                        <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check) {
                            echo '<li><a href="wishlist.php">Wishlist</a></li>';
                        }
                        ?>

                        <li><a href="contact.php">Contact</a> </li>
                        <div class="clear"></div>
                    </ul>
                </div>