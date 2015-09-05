<?php
Class Model_user extends CI_Model{
    const DB_TABLE = 'username';
    
    var	$id;
    var	$username;
    var	$password;
    var	$email;
    var	$fullname;
    var	$salt;
    var	$resetcode;
    var	$active = 1;
    var	$token;
    var	$created_date;
    var	$updated_date;
    var	$usergroupid = CMS_DEFAULT_USERGROUP_ID;
    var	$usercreatedid;
    var	$userupdatedid;
    
    /**
     * Tao ra chuoi mat khau da duoc ma hoa
     * @param string
     * @param string
     * @return string
     **/
    public function password_algorithm(){
        return sha1($this->password.md5($this->salt));
    }
    
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
     * Count rows
     * @param array
     * @return integer
     **/
     public function CountRow($keyword = '', $param = null){
        if(is_array($param))
            return $this->db->like('username', $keyword)->where($param)->get(self::DB_TABLE)->num_rows();
        else
            return $this->db->like('username', $keyword)->get(self::DB_TABLE)->num_rows();
     }
     
    /**
     * Chon ra cac bang ghi theo tieu chi chuyen vao
     * @param array
     * @return array
     **/
    public function SelectByX($param = null, $keyword = '', $orderby = 'id DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        if(is_array($param))
            return $this->db->like('username', $keyword)->where($param)->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
        else
            return $this->db->like('username', $keyword)->order_by($orderby)->limit($perpage, $page)->get(self::DB_TABLE)->result_array();
            
        /** Tested OK **/
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
     * Create a new username
     * @param string
     * @param string
     * @param string
     * @param int
     * @param int
     * @return Row Affected
     **/
    
    public function register($username, $password, $email, $usercreatedid, $usergroupid = CMS_DEFAULT_USERGROUP_ID){
        
        $this->salt = random_string('alpha', 20);
        $this->username = $username;
        $this->password = $password;
        $this->password = $this->password_algorithm();
        $this->email = $email;
        $this->usercreatedid = $usercreatedid;
        $this->usergroupid = $usergroupid;
        $this->created_date = gmdate('Y-m-d H:i:s');
        
        $this->db->insert(self::DB_TABLE, $this);
        
        return $this->db->affected_rows();
        
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
     * Editing row by username
     * @param array
     * @param integer
     * @return true/false
     **/
     
     public function ModifyRow($NewData, $username = ''){
        
        unset($NewData['username']);
        $this->username = $username;
        
        if($userdata = $this->SelectByX(array('username' => $username))){
            
            $this->populate($userdata[0]);
            
            //Tranh truong hop khong doi pass
            if($NewData['password'] == ''){
                unset($NewData['password']);
            }
            
            $this->populate($NewData);
            //Truong hop doi password
            if(isset($NewData['password']) && $NewData['password'] != ''){
                $this->password = $this->password_algorithm();
            }
            
            $this->db->update(self::DB_TABLE, (array)$this, array('username' => $username));
        }
        else{
            $this->populate($NewData);
            $this->id = null;
            return $this->register($this->username, $this->password, $this->email, $this->usercreatedid, $this->usergroupid);
        }
        
        return $this->db->affected_rows();
        
        /** Tested OK **/
     }
}