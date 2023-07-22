<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php

class product {

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files){
        
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name); 
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $type=="" || $price=="" || $file_name==""){
            $alert = "<span class='error'>Product must be not empty!!</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,type,price,image) 
            VALUES('$productName','$category','$brand ','$product_desc','$type','$price','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Thêm sản phẩm thành công!!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm sản phẩm không thành công!!</span>";
                return $alert;
            }
            
        }
    }
    public function show_product(){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        order by tbl_product.productId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data,$files,$id){

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name); 
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName=="" || $category=="" || $brand=="" || $product_desc=="" || $type=="" || $price==""){
            $alert = "<span class='error'>Files Không được để trống!!</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //nếu người dùng chọn ảnh
                if($file_size > 1048567){
                    $alert = "<span class='error'>Kích thước hình ảnh phải nhỏ hơn 10MB</span>";
                    return $alert;
            }
            elseif(in_array($file_ext, $permited) === false){
                $alert = "<span class='error'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
                return $alert;
            }
            $query = "UPDATE tbl_product SET
             productName = '$productName',
             brandId = '$brand',
             catId = '$category',
             product_desc = '$product_desc',
             type = '$type',
             price = '$price'
             --image = '$unique_image'   
             WHERE productId = '$id'";
        }else{
            // nếu người dùng không chọn ảnh
            $query = "UPDATE tbl_product SET
             productName = '$productName',
             brandId = '$brand',
             catId = '$category',
             product_desc = '$product_desc',
             type = '$type',
             price = '$price'
             WHERE productId = '$id'";
        }
    
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Cập nhật sản phẩm thành công.</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Cập nhật sản phẩm chưa thành công.!</span>";
                return $alert;
            }
        }
    } 
    
    public function del_product($id){
        $query = "DELETE  FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if($result){
                $alert = "<span class='success'>Đã xoá sản phẩm.</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Xoá sản phẩm chưa thành công.!</span>";
                return $alert;
            }
        return $result;
    }

    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    //End back end
    //Feathered = 1 
    //non-Feathered = 0
    public function getproduct_feathered(){
        $query = "SELECT * FROM tbl_product WHERE type = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    //new product
    public function getproduct_new(){
        $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesDell(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '5' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesIphone(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '6' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesSamsung(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '7' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastesOppo(){
        $query = "SELECT * FROM tbl_product WHERE brandId = '8' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>