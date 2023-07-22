<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php

class customer {

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_Customer($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);       
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']); 
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        
        if($name =="" || $address =="" || $city =="" || $country =="" || $zipcode =="" || $phone =="" || $email =="" || $password ==""){
            $alert = "<span class='error'>Thông tin không được để trống xin vui lòng nhập lại.!!</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class='error'>Email này đã tồn tại.!!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) 
                    VALUES('$name','$address','$city ','$country','$zipcode','$phone','$email', '$password')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Đăng kí thành công!!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Đăng kí không thành công.!!</span>";
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if($email =="" || $password ==""){
            $alert = "<span class='error'>Tài khoản hoặc mật khẩu không được để trống!!</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
               Session::set('customer_login', true);
               Session::set('customer_id', $value['id']);
               Session::set('customer_name', $value['name']);
               header('Location:order.php');
            }else{
                $alert = "<span class='error'>Thông tin Email hoặc mật khẩu không đúng.!!</span>";
                return $alert;
            }
        }
    }
    public function show_customers($id){
        $query = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result = $this->db->select($query);
        return $result; 
    }

    public function update_customers($data, $id){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']); 
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);  
        
        if($name =="" || $address =="" || $zipcode =="" || $phone =="" || $email ==""){
            $alert = "<span class='error'>Thông tin không được để trống xin vui lòng nhập lại.!!</span>";
            return $alert;
        }else{
            $query = "UPDATE tbl_customer SET name='$name', address='$address', zipcode='$zipcode', phone='$phone', email='$email' WHERE id='$id'";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Chỉnh sửa thành công!!</span>";
                   return $alert;
            }else{
                $alert = "<span class='error'>Chỉnh sửa không thành công.!!</span>";
                return $alert;
            }     
        }
    }
}
?>