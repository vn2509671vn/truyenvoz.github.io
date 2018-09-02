<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDetail($id){
        $sql = "select * from product where id = '".$id."' order by id DESC";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateView($id){
        $sql = "update product set views = views + 1 where id = '".$id."'";
        $query = $this->db->query($sql);
        if($query){
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getSearchDetail($txtSearch){
        $sql = "select product.*, users.name from product, users where product.active = 1 and product.user = users.user_id and product.title like N'%".$txtSearch."%' order by product.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getFullStory($litmit, $offset){
        if(is_null($offset)) $offset = 0;
        $sql = "select * from category where parent = 1 order by cat_id desc limit $offset,$litmit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getFullStoryNumrow(){
        $sql = "select * from category where parent = 1 order by cat_id desc";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function getFullStoryDetail($cat_id){
        $sql = "select product.*, users.name from product, users, product_cats where product.active = 1 and product.user = users.user_id and product_cats.product_id = product.id and product_cats.cat_id = '".$cat_id."' order by product.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getCategory($id){
        $sql = "select * from category where cat_id = '".$id."'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function getPartStoryDetail($litmit, $offset){
        if(is_null($offset)) $offset = 0;
        $sql = "select product.*, users.name from product, users, product_cats where product.active = 1 and product.user = users.user_id and product_cats.product_id = product.id and product_cats.cat_id = '4' order by product.id DESC limit $offset,$litmit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getPartStoryDetailNumrow(){
        $sql = "select product.*, users.name from product, users, product_cats where product.active = 1 and product.user = users.user_id and product_cats.product_id = product.id and product_cats.cat_id = '4' order by product.id DESC";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function getTopStory(){
        $sql = "select * from product order by views desc limit 0, 10";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}