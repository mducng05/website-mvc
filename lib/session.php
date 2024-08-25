<?php
/**
 *Session Class
 **/
//mỗi lần thêm, thanh toán, đăng nhập thì session sẽ lưu cái phiên giao dịch và mỗi lần refesh (làm mới chán) thì vẫn còn lưu
class Session{
    public static function init(){
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }
//set key thành giá trị VD như user name đăng nhập là admin thì nó sẽ xuất ra giá trị là admin
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }
//check xem phiên giao dịch có tồn tại khôn
    public static function checkSession(){
        self::init();
        if (self::get("adminlogin")== false) {
            self::destroy();
            header("Location:login.php");
        }
    }

    public static function checkLogin(){
        self::init();
        if (self::get("adminlogin")== true) {
            header("Location:index.php");
        }
    }

    public static function destroy(){
        session_destroy();
        header("Location:login.php");
    }
}
?>
