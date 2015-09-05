<?php
Class Model_product_cate extends CI_Model{
    const DB_TABLE = 'product_cate';
    
    //var $id;
     var $product_id        = 0;
     var $category_id       = 0; 

    
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
    public function SelectByX($param = null){
        return $this->db->where($param)->get(self::DB_TABLE)->result_array();
            
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
    public function InsertNewItem($InputData = null){
        
        $this->populate($InputData);
        
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
            return true;
        }
        
        if(!is_numeric($id))
            return false;
        
        if($this->SelectByID($id)){
            $this->db->delete(self::DB_TABLE, array('id' => $id));
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
     * Delete by productID
     * @param ProductID - Integer
     * 
     **/
     public function DeleteByProID($id = null){
        $this->db->delete(self::DB_TABLE, array('product_id' => $id));
        return true;
     }
}