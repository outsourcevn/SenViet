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
     * Chon ra 1 bang ghi theo ID
     * @param array
     * @return array
     **/
    public function SelectByID($id = 0){
        if(!is_numeric($id))
            return false;
        
        if($data = $this->db->where('id', $id)->get(self::DB_TABLE)->row_array()){
            $this->populate($data);
            
            return $this;
        }else{
            return false;
        }
        
        /** Tested OK **/
    }
    
    
    /**
     * Adding new Usergroup
     * @param array
     * @param integer
     * @return Num Rows Affected
     **/
    public function InsertNewItem($data, $uid){
        
        $this->populate($data);
        
        $this->created_date = gmdate('Y-m-d H:i:s');
        $this->updated_date = gmdate('Y-m-d H:i:s');
        $this->userid_created = $uid;
        
        $this->db->insert(self::DB_TABLE, $this);
        return $this->db->affected_rows();
    }
    
    /**
     * Count rows
     * @param array
     * @return integer
     **/
     public function CountRow($keyword = '', $param = null){
        if(is_array($param))
            return $this->db->or_like(array('title' => $keyword, 'caption' => $keyword))->where($param)->get(self::DB_TABLE)->num_rows();
        else
            return $this->db->or_like(array('title' => $keyword, 'caption' => $keyword))->get(self::DB_TABLE)->num_rows();
     }
     
     /**
     * Chon ra cac bang ghi theo tieu chi chuyen vao
     * @param array
     * @return array
     **/
    public function SelectByX($param = null, $keyword = '', $orderby = 'id DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        if(is_array($param))
            return $this->db->or_like(array('title' => $keyword, 'caption' => $keyword))->where($param)->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
        else
            return $this->db->or_like(array('title' => $keyword, 'caption' => $keyword))->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
            
        /** Tested OK **/
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
        $this->db->update(self::DB_TABLE, $this , array('id' => $id));
        
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