<?php
Class Model_slide extends CI_Model{
    const DB_TABLE = 'slide';
    
    var $title;
    var $link;
    var $image_link;
    var $caption;
    var $created_date;
    var $updated_date;
    var $userid_created;
    var $publish;
    var $order = 0;
    
    
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
     public function All($limit = CMS_ITEM_PER_PAGE, $OrderBy = '`order` ASC'){
        $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` WHERE `publish` = '1' ORDER BY ".$OrderBy." LIMIT $limit";
        $row = $this->db->query($sql);
        
        return $row->result_object();
     }
}