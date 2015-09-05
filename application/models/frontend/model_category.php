<?php
class Model_category extends CI_Model{
    const DB_TABLE = 'category';
    var $title;
    var $alias;
    var $parentid;
    var $description;
    var $navigation;
    var $source;
    var $order;
    var $level;
    var $lft;
    var $rgt;
    var $image;
    var $publish;
    var $meta_title;
    var $meta_keywords;
    var $meta_description;
    var $userid_created;
    var $userid_updated;
    var $created_date;
    var $updated_date;
    
    /**
     * Day cac bien tu du lieu truyen ve ra doi tuong
     * @param array
     **/
     function populate($arr){
        foreach($arr as $key => $val){
            if(property_exists(get_class($this), $key))
                $this->{$key} = $val;
        }
     }
     
     /**
      * Select By Id
      * @author Ta Minh Duc
      * @param Integer
      * @return Object
      **/
     public function find($id){
        
        $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` WHERE `id` = '?'";
        
        $row = $this->db->query($sql, $id);
        
        return $row->row_object();
     }
     
     /**
      * Select List All Categories
      * @author Ta Minh Duc
      * @return Array Objects
      **/
     public function All($limit_level = 1, $OrderBy = '`lft` ASC'){
        $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` WHERE `level` <= $limit_level AND `publish` = 1 ORDER BY ".$OrderBy;
        $row = $this->db->query($sql);
        
        return $row->result_object();
     }
     
     /**
      * Select List Categories by condition
      * @author Ta Minh Duc
      **/
     public function SelectCategory(){
        
     }
     
     /**
      * Select Category By Alias
      * @author Ta Minh Duc
      **/
     
     public function FindByAlias($alias = null){
        $sql = "SELECT * FROM `cms_category` WHERE `alias` = ?";
        
        $row = $this->db->query($sql, array($alias));
        return $row->row_object();
     }
}
?>