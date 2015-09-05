<?php
Class Model_usergroup extends CI_Model{
    const DB_TABLE = 'usergroup';
    
    var $id;
    var	$title;
    var	$created_date;
    var	$updated_date;
    var	$userid_created;
    var	$permission_key = '["controller\/user\/info"]';
    var	$status = 1;

    
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
    public function SelectByX($param = null, $keyword = '', $orderby = 'id DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        if(is_array($param))
            return $this->db->like('title', $keyword)->where($param)->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
        else
            return $this->db->like('title', $keyword)->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
            
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
            
            return $this;
        }else{
            return false;
        }
        
        /** Tested OK **/
    }
    
    
    /**
     * Adding new Usergroup
     * @param string
     * @param integer
     * @param array
     * @return Num Rows Affected
     **/
    public function InsertNewItem($title = '', $uid = 1, $perm = NULL){
        $this->title = $title;
        $this->created_date = gmdate('Y-m-d H:i:s');
        $this->updated_date = gmdate('Y-m-d H:i:s');
        $this->userid_created = $uid;
        
        if(isset($perm) && $perm != null){
            $this->permission_key = json_encode($perm);
        }
        
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
        unset($NewData['id']);
        
        $NewData['permission_key'] = json_encode($NewData['permission_key']);
        $NewData['updated_date'] = gmdate('Y-m-d H:i:s');
        $this->db->update(self::DB_TABLE, $NewData, array('id' => $id));
        
        return $this->db->affected_rows();
        /** Tested OK **/
     }
}