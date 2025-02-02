<?php

$filepath = realpath(dirname(__FILE__)); // Lấy đường dẫn của thư mục hiện tại
include_once ($filepath. '/../lib/database.php');
include_once ($filepath. '/../helpers/format.php');
?>

<?php
/**
 *
 */
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_binhluan()
    {
        $product_id = $_POST['product_id_binhluan'];
        $tenbinhluan = $_POST['tennguoibinhluan'];
        $binhluan = $_POST['binhluan'];
//        echo $product_id;
//        echo $tenbinhluan;
//        echo $binhluan;
        if($tenbinhluan == "" || $binhluan == "" ){
            $alert = "<span class ='error' > Fileds must be not empty </span>" ;
            return $alert ;
        }else{
            $query = "INSERT INTO tbl_binhluan(tenbinhluan , binhluan , product_id ) VALUES ('$tenbinhluan' ,
                             '$binhluan' , '$product_id' )";
            $result = $this->db->insert($query);
            if ($result){
                $alert = "<span class='success'> Bình luận sẽ được admin kiểm duyệt </span>";
                return $alert;
            }else{
                $alert = "<span class='error'> Bình luận không thành công </span>";
                return $alert;
            }
        }
    }

    public function insert_customers($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email= mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if($name =="" || $city == "" || $zipcode =="" || $email =="" || $address =="" || $country =="" || $phone =="" || $password==""){
            $alert = "<span class ='error' > Fileds must be not empty </span>" ;
            return $alert ;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1 " ;
            $result_check = $this->db->select($check_email);
            if ($result_check){
                $alert = "<span class='error'>Emaill Already Existed ! Please Enter Another Email</span>";
                return $alert ;
            }else{
                $query = "INSERT INTO tbl_customer(name , city , zipcode , email, address , country , phone ,password) VALUES ('$name' ,
                             '$city' , '$zipcode' , '$email' , '$address' , '$country' , '$phone' , '$password')";
                $result = $this->db->insert($query);
                if ($result){
                    $alert = "<span class='success'> Customer Created Successfully </span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'> Customer Created Not Success </span>";
                    return $alert;
                }
            }
        }
    }


    function login_customers($data) {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if (empty($email) || empty($password)) {
            $alert = "<span class='error'>Password and Email must not be empty</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result_check = $this->db->select($check_login);

            if ($result_check) {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                echo "<script>window.location.href = 'order.php';</script>";
                exit;
            } else {
                $alert = "<span class='error'>Email or Password doesn't match</span>";
                return $alert;
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id' " ;
        $result = $this->db->select($query);
        return $result ;
    }

    public function update_customers($data , $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email= mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if($name ==""  || $zipcode =="" || $email =="" || $address =="" || $phone =="" ){
            $alert = "<span class ='error' > Fileds must be not empty </span>" ;
            return $alert ;
        }else{
            $query = "UPDATE tbl_customer SET name = '$name' , zipcode = '$zipcode' , email = '$email', address ='$address' , phone = '$phone' 
                            WHERE id = '$id'";
            $result = $this->db->insert($query);
            if ($result){
                $alert = "<span class='success'> Customer Update Successfully </span>";
                return $alert;
            }else{
                $alert = "<span class='error'> Customer Update Not Success </span>";
                return $alert;
            }
        }
    }

}
?>
