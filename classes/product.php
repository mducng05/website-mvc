<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class product
{
    private $fm;
    private $db;


    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($data, $files)
    {
        $productName = isset($data['productName']) ? mysqli_real_escape_string($this->db->link, $data['productName']) : '';
        $brand = isset($data['brand']) ? mysqli_real_escape_string($this->db->link, $data['brand']) : '';
        $category = isset($data['category']) ? mysqli_real_escape_string($this->db->link, $data['category']) : '';
        $product_desc = isset($data['product_desc']) ? mysqli_real_escape_string($this->db->link, $data['product_desc']) : '';
        $price = isset($data['price']) ? mysqli_real_escape_string($this->db->link, $data['price']) : '';
        $type = isset($data['type']) ? mysqli_real_escape_string($this->db->link, $data['type']) : '';

        // kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif' ,'webp');
        $file_name = isset($files['image']['name']) ? $_FILES['image']['name'] : '';
        $file_size = isset($files['image']['size']) ? $_FILES['image']['size'] : '';
        $file_temp = isset($files['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='error'>Các trường không được rỗng</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName , brandId , catId , product_desc , price , type ,image) VALUES ('$productName' , '$brand' , '$category' , '$product_desc' , '$price' , '$type' , '$unique_image' )";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Product Not Success</span>";
                return $alert;
            }
        }
    }

    public function insert_slider($data, $files){
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type =  mysqli_real_escape_string($this->db->link, $data['type']);
      
        // kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif' ,'webp');
        $file_name = isset($files['image']['name']) ? $_FILES['image']['name'] : '';
        $file_size = isset($files['image']['size']) ? $_FILES['image']['size'] : '';
        $file_temp = isset($files['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;
    
        if ($sliderName == "" || $type == "") {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // nếu người dùng chọn ảnh
                if ($file_size > 2048000) {
                    $alert = "<span class='error'>Hình nền dưới 2MB !</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='error'>You can upload only: " . implode('.', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName, type ,slider_image) VALUES ('$sliderName', '$type', '$uploaded_image')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Slider Added Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Slider Added Not Success</span>";
                    return $alert;
                }
    
            } 
        }
    }
    
    public function show_slider(){
        $query = "SELECT * FROM tbl_slider WHERE type ='1' order by sliderId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_type_slider($id,$type){
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET type ='$type' WHERE sliderId='$id'";
        $result = $this->db->update($query);
        return $result;

    }

    public function del_slider($id)
    {
        $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert =" <span class ='success'>Slider Deleted Successfully</span>";
            return $alert;
        }else{
            $alert ="<span class='error'>Slider Deleted Not Success</span>";
            return $alert;
        }
    }
    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
    FROM tbl_product 
    INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
    INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
    ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data, $files, $id)
    {
        $productName = isset($data['productName']) ? mysqli_real_escape_string($this->db->link, $data['productName']) : '';
        $brand = isset($data['brand']) ? mysqli_real_escape_string($this->db->link, $data['brand']) : '';
        $category = isset($data['category']) ? mysqli_real_escape_string($this->db->link, $data['category']) : '';
        $product_desc = isset($data['product_desc']) ? mysqli_real_escape_string($this->db->link, $data['product_desc']) : '';
        $price = isset($data['price']) ? mysqli_real_escape_string($this->db->link, $data['price']) : '';
        $type = isset($data['type']) ? mysqli_real_escape_string($this->db->link, $data['type']) : '';

        $permited = array('jpg', 'jpeg', 'png', 'gif' ,'webp');
        $file_name = isset($files['image']['name']) ? $_FILES['image']['name'] : '';
        $file_size = isset($files['image']['size']) ? $_FILES['image']['size'] : '';
        $file_temp = isset($files['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // nếu người dùng chọn ảnh
                if ($file_size > 204800) {
                    $alert = "<span class='success'>Hình nền dưới 2MB !</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='success'>You can upload only: " . implode('.', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    image = '$unique_image',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";
                $result = $this->db->update($query);
                if ($result) {
                    $alert = "<span class='success'>Cập nhật thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
                }

            } else {
                // nếu người dùng không chọn ảnh
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    type = '$type',
                    price = '$price',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";

                $result = $this->db->update($query);
                if ($result) {
                    $alert = "<span class='success'>Cập nhật thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
                }
            }
        }
    }

    public function del_product($id){
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert =" <span class ='success'>Product Deleted Successfully</span>";
            return $alert;
        }else{
            $alert ="<span class='error'>Product Deleted Not Success</span>";
            return $alert;
        }

    }

    

    public function getproductbyId($id) {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'"; // Đã chỉnh sửa cú pháp của câu lệnh SELECT và WHERE
        $result = $this->db->select($query);
        return $result;
    }

    //END RACKEND
    public function getproduct_feathered(){
        $sp_tungtrang = 20;
        if (!isset($_GET['Trang'])) {
            $Trang = 1;
        } else {
            $Trang = $_GET['Trang'];
        }
        $tung_trang = ($Trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new() {
        $sp_tungtrang = 20; // Giới hạn số sản phẩm trên mỗi trang
        if (!isset($_GET['Trang'])) {
            $Trang = 1;
        } else {
            $Trang = $_GET['Trang'];
        }
        $tung_trang = ($Trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_all_product(){
        $query = "SELECT * FROM tbl_product ";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_products()
    {
        $query = "SELECT * FROM tbl_product ";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id){
        $query = "
            SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'
            ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesIphone(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesOppo(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesHuawei(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '8' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesSamsung(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function LastesOp(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY CAST(price AS DECIMAL(10, 2)) DESC, productId DESC LIMIT 4;";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesIp()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY CAST(price AS DECIMAL(10, 2)) DESC, productId DESC LIMIT 4;";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesSS()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY CAST(price AS DECIMAL(10, 2)) DESC, productId DESC LIMIT 4;";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesHW()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = '8' ORDER BY CAST(price AS DECIMAL(10, 2)) DESC, productId DESC LIMIT 4;";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_compare($customer_id){
        $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompare($productId, $customer_id){
        $productId = mysqli_real_escape_string($this->db->link , $productId);
        $customer_id = mysqli_real_escape_string($this->db->link , $customer_id);
      
        // Kiểm tra giá trị không rỗng và hợp lệ
        if(empty($productId) || empty($customer_id)) {
            $alert = "<span class='error'>Thông tin sản phẩm hoặc khách hàng không hợp lệ</span>";
            return $alert;
        }
    
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query);
    
        // Kiểm tra kết quả truy vấn
        if($result) {
            $row = $result->fetch_assoc();
            $productName = $row['productName'];
            $price = $row['price'];
            $image = $row['image'];
    
            $query_insert = "INSERT INTO tbl_compare(productId, price, image, customer_id, productName) VALUES ('$productId', '$price', '$image', '$customer_id', '$productName')";
            $insert_compare = $this->db->insert($query_insert);
    
            if ($insert_compare) {
                $alert = "<span class='success'>Thêm vào so sánh thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm vào so sánh không thành công</span>";
                return $alert;
            }
        } else {
            $alert = "<span class='error'>Không tìm thấy sản phẩm</span>";
            return $alert;
        }
    }

    public function insertWishlist($productId, $customer_id){
        $productId = mysqli_real_escape_string($this->db->link , $productId);
        $customer_id = mysqli_real_escape_string($this->db->link , $customer_id);
      
        // Kiểm tra giá trị không rỗng và hợp lệ
        if(empty($productId) || empty($customer_id)) {
            $alert = "<span class='error'>Thông tin sản phẩm hoặc khách hàng không hợp lệ</span>";
            return $alert;
        }
    
        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query);
    
        // Kiểm tra kết quả truy vấn
        if($result) {
            $row = $result->fetch_assoc();
            $productName = $row['productName'];
            $price = $row['price'];
            $image = $row['image'];
    
            $query_insert = "INSERT INTO tbl_wishlist(productId, price, image, customer_id, productName) VALUES ('$productId', '$price', '$image', '$customer_id', '$productName')";
            $insert_wishlist = $this->db->insert($query_insert);
    
            if ($insert_wishlist) {
                $alert = "<span class='success'>Thêm vào mục ưa thích thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm vào  mục ưa thích không thành công</span>";
                return $alert;
            }
        } else {
            $alert = "<span class='error'>Không tìm thấy sản phẩm</span>";
            return $alert;
        }
    }
    public function get_wishlist($customer_id){
        $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
        public function del_wlist($proid, $customer_id){
        $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id ='$customer_id'";
        $result = $this->db->delete($query);
        return $result;
        }

    public function search_product($tukhoa) {
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM tbl_product where productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>
<!--//-->
<!--//-->
<!--//    public function update_category($catName, $id)-->
<!--//    {-->
<!--//-->
<!--//        $catName = $this->fm->validation($catName);-->
<!--//        $catName = mysqli_real_escape_string($this->db->link, $catName);-->
<!--//        $id = mysqli_real_escape_string($this->db->link, $id);-->
<!--//-->
<!--//        if (empty($catName)) {-->
<!--//            $alert = "<span class='error'>Khong duoc bo trong</span>";-->
<!--//            return $alert;-->
<!--//        } else {-->
<!--//            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";-->
<!--//            $result = $this->db->update($query);-->
<!--//            if ($result) {-->
<!--//                $alert = "<span class='success'>Category Updated Successfully</span>";-->
<!--//                return $alert;-->
<!--//            } else {-->
<!--//                $alert = "<span class='error'>Category Updated Not Success</span>";-->
<!--//                return $alert;-->
<!--//            }-->
<!--//        }-->
<!--//    }-->
<!--//-->
<!--//    public function del_category($id)-->
<!--//    {-->
<!--//        $query = "DELETE FROM tbl_category WHERE catId = '$id'";-->
<!--//        $result = $this->db->delete($query);-->
<!--//        if ($result) {-->
<!--//            $alert = "<span class='success'>Category Deleted Successfully</span>";-->
<!--//            return $alert;-->
<!--//        } else {-->
<!--//            $alert = "<span class='error'>Category Deleted Not Success</span>";-->
<!--//            return $alert;-->
<!--//        }-->
<!--//    }-->
<!--//-->
<!--//    public function getcatbyId($id)-->
<!--//    {-->
<!--//        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";-->
<!--//        $result = $this->db->select($query);-->
<!--//        return $result;-->
<!--//    }-->
<!--//-->
<!--//    public function show_category_fontend()-->
<!--//    {-->
<!--//        $query = "SELECT * FROM tbl_category ORDER BY catId DESC ";-->
<!--//        $result = $this->db->select($query);-->
<!--//        return $result;-->
<!--//    }-->
<!--//-->
<!--//    public function get_product_by_cat($id){-->
<!--//        $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY catId DESC LIMIT 8 " ;-->
<!--//        $result = $this->db->select($query);-->
<!--//        return $result;-->
<!--//    }-->
<!--//-->
<!--//    public function get_name_by_cat($id){-->
<!--//        $query = "SELECT tbl_product.*,tbl_category.catName , tbl_category.catId FROM tbl_product, tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catID = '$id' LIMIT 1";-->
<!--//        $result = $this->db->select($query);-->
<!--//        return $result;-->
<!--//    }-->
<!--    public function getproductbyId($id) {-->
<!--    $query = "SELECT * FROM tbl_product WHERE productId = '$id'"; // Đã chỉnh sửa cú pháp của câu lệnh SELECT và WHERE-->
<!--    $result = $this->db->select($query);-->
<!--    return $result;-->
<!--}-->
<!---->
<!--}-->
<!--?>-->
