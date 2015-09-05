<?php
Class Model_category extends CI_Model{
    const DB_TABLE = 'category';
    
    //protected $id;
    var $title;
    var $alias;
    var $parentid;
    var $description;
    var $order          = 0;
    var $level          = 0;
    var $lft            = 0;
    var $rgt            = 0;
    var $image;
    var $publish        = 1;
    var $meta_title     = '';
    var $meta_keywords  = '';
    var $meta_description;
    var $userid_created = 0;
    var $userid_updated = 0;
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
     * Chon ra cac bang ghi theo tieu chi chuyen vao
     * @param array
     * @return array
     **/
    public function SelectByX($param = null, $keyword = '', $orderby = '`lft` ASC'){
        if(is_array($param))
            return $this->db->or_like('title', $keyword)->or_like('description', $keyword)->where($param)->order_by($orderby)->get(self::DB_TABLE)->result_array();
        else
            return $this->db->or_like('title', $keyword)->or_like('description', $keyword)->order_by($orderby)->get(self::DB_TABLE)->result_array();
            
        /** Tested OK **/
    }
    
    /**
     * Count rows
     * @param array
     * @return integer
     **/
     public function CountRow($keyword = '', $param = null){
        if(is_array($param))
            return $this->db->like('title', $keyword)->where($param)->get(self::DB_TABLE)->num_rows();
        else
            return $this->db->like('title', $keyword)->get(self::DB_TABLE)->num_rows();
     }
    
    /**
     * Chon ra 1 bang ghi theo ID
     * @param array
     * @return array
     **/
    public function SelectByID($id = 0){
        if(!is_numeric($id))
            return false;
        
        if($data = $this->db->where('id', $id)->get(self::DB_TABLE)->row_array()){
            $this->populate($data);
            
            //print_r($this);
            
            return $this;
        }else{
            return false;
        }
        
        /** Tested OK **/
    }
    
    
    /**
     * Adding new Usergroup
     * @param Array
     * @return Num Rows Affected
     **/
    public function InsertNewItem($InputData = null, $uid = 1){
        
        $this->populate($InputData);
        
        $this->created_date = gmdate('Y-m-d H:i:s');
        $this->updated_date = gmdate('Y-m-d H:i:s');
        $this->userid_created = $uid;
        
        $this->db->insert(self::DB_TABLE, $this);
        return $this->db->affected_rows();
    }
    
    
    /**
     * Delete rows from database
     * @param mixed
     * @return bool
     **/
    public function delete($id){
        if(is_array($id)){
            $this->db->where_in('id', $id)->delete(self::DB_TABLE);
            $this->db->where_in('category_id', $id)->delete('product_cate');
            return true;
        }
        
        if(!is_numeric($id))
            return false;
        
        if($this->SelectByID($id)){
            $this->db->delete(self::DB_TABLE, array('id' => $id));
            $this->db->delete('product_cate', array('product_id' => $id));
            return true;
        }
        else{
            return false;
        }
        
        /** Tested OK **/
    }
    
    /**
     * Change state of a toggle field
     * @param string
     * @param integer
     * @return bool
     **/
    public function toggle_item($field, $id){
        if(is_array($id)){
            $this->db->where_in('id', $id)->update(self::DB_TABLE, array($field => 1));
            return true;
        }
        
        if(!is_numeric($id))
            return false;
        
        if($input_data = $this->SelectByID($id)){
            $this->db->update(self::DB_TABLE, array($field => ($input_data->{$field} == 1 ? 0 : 1)), array('id' => $id));
            return true;
        }
        else{
            return false;
        }
        
        /** Tested OK **/
    }
    
    /**
     * Modifying a record
     * @param mixed
     * @param int
     * @return bool
     **/
     public function ModifyRow($NewData, $id){
        $this->populate($NewData);
        $this->updated_date = gmdate('Y-m-d H:i:s');
         
        $this->db->update(self::DB_TABLE, $this, array('id' => $id));
        
        return $this->db->affected_rows();
        /** Tested OK **/
     }
     
     /**
      * Sort Function()
      **/
    public function SortItems($params){
        
        $total_row_affected = 0;
        
        if(isset($params) && count($params)){
            foreach($params as $k => $v){
                $this->db->update(self::DB_TABLE, array('order' => $v), array('id' => $k));
                $total_row_affected += $this->db->affected_rows();
            }
        }
        
        return $total_row_affected;
    }
}