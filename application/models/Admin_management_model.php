<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_management_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function loginUser($account, $pwd){
        $sql = "select * from users where account = '$account' and password = '$pwd'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getUserDetail($account){
        $sql = "select * from users where account = '$account'";
        $query = $this->db->query($sql);
        return $query->row_array(); // it returns an array
    }
    
    public function registerUser($name, $account, $email, $password){
        $existMail = $this->existMail($email);
        if($existMail){
            return false;
        }
        else {
            $this->insertUser($name, $account, $email, $password);
            $success = $this->existMail($email);
            return $success;
        }
    }
    
    public function existMail($email){
        $sql = "select * from users where email = '$email'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function insertUser($name, $account, $email, $password){
        // Default role là admin
        $sql = "insert into users(name, account, email, password, create_date, role) ";
        $sql .= "values(N'$name', '$account', '$email', '$password', CURDATE(), 1)";
        $this->db->query($sql);
    }
    
    public function getListCat(){
        $sql = "select * from category";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function insertCat($name, $slug, $mota, $parent){
        $sql = "insert into category(name, slug, parent, description) ";
        $sql .= "values(N'$name', '$slug', '$parent', '$mota')";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function editCat($id, $name, $slug, $mota, $parent){
        $sql = "update category set name = N'$name', slug = '$slug', parent = '$parent', description = '$mota' where cat_id = '$id'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteCat($id){
        $sql = "DELETE FROM category WHERE cat_id = $id";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function acceptEdit($id, $parent){
        $sql = "select * from category where parent = '$id' and cat_id = '$parent'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return false;
        }
        else {
            return true;
        }
    }
    
    public function addProduct($title, $slug, $description, $active, $user_id){
        $sql = "insert into product(title, slug, description, active, create_date, updated_date, views, user) ";
        $sql .= "values(N'$title', '$slug', N'$description', '$active', NOW(), NOW(), 0, '$user_id')";
        $query = $this->db->query($sql);
        return $this->db->insert_id();
    }
    
    public function editProduct($proID, $title, $slug, $description, $user_id){
        $sql = "update product set title = N'".$title."', slug = N'".$slug."', description = N'".$description."', updated_date = NOW() where id = '".$proID."' and user = '".$user_id."'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function addProductCat($procID, $catID){
        $sql = "insert into product_cats(product_id, cat_id) ";
        $sql .= "values('$procID', '$catID')";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function delProductCat($procID){
        $sql = "delete from product_cats where product_id = '$procID'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getProductCat($procID){
        $sql = "select * from product_cats where product_id = '".$procID."'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function deleteItem($table, $id){
        $sql = "update $table set active = 0 where id = '$id'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getListProduct(){
        $sql = "select product.*, users.name from product, users where product.active = 1 and product.user = users.user_id order by product.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getListProductParameters($litmit, $offset){
        if(is_null($offset)) $offset = 0;
        $sql = "select product.*, users.name from product, users where product.active = 1 and product.user = users.user_id order by product.id DESC limit $offset,$litmit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getListProductNumrow(){
        $sql = "select product.*, users.name from product, users where product.active = 1 and product.user = users.user_id order by product.id DESC";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function getProductDetai($procID){
        $sql = "select * from product where id = '".$procID."' order by id DESC";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function insertContact($name, $email, $phone, $message){
        $sql = "insert into contact(name, email, phone, message) values (N'$name', '$email', '$phone', '$message')";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
}