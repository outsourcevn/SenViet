<?php
Class Model_product extends CI_Model{
    const DB_TABLE = 'products';
    
    //var $id;
    var $title              = '';
    var $description        = '';
    var $alias              = '';
    var $brand_id           = 0;
    var $meta_description   = '';
    var $meta_keyword       = '';
    var $meta_title         = '';
    var $publish            = 1;
    var $is_featured        = 1;
    var $status             = 1;
    var $price              = 0;
    var $sale_price         = 0;
    var $created_date       = null;
    var $updated_date       = null;
    var $userid_created     = 1;

    
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
    public function SelectByX($param = null, $keyword = '', $orderby = '`ID` DESC'){
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
     * Return Inserted ID
     **/
     public function inserted_id(){
        return $this->db->insert_id();
     }
    
    
    /**
     * Delete rows from database
     * @param mixed
     * @return bool
     **/
    public function delete($id){
        if(is_array($id)){
            $this->db->where_in('id', $id)->delete(self::DB_TABLE);
            $this->db->where_in('FK_id', $id)->delete('images');
            $this->db->where_in('product_id', $id)->delete('product_cate');
            return true;
        }
        
        if(!is_numeric($id))
            return false;
        
        if($this->SelectByID($id)){
            $this->db->delete(self::DB_TABLE, array('id' => $id));
            $this->db->delete('images', array('FK_id' => $id));
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
    
    /**
     * Selecting Data With Filter Condition
     **/
    public function SelectDataWithFilter($keyword = '', $category_id = null, $brand_id = null, $price_from = null, $price_to = null, $order_by = 'ID DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        $this->db->select('*');
        $this->db->from(self::DB_TABLE);
        $this->db->join('product_cate', self::DB_TABLE.'.id = product_cate.product_id', 'left');
        
        if($brand_id){
            $this->db->where('brand_id', $brand_id);
        }
        
        if($category_id){
            $this->db->where('category_id', $category_id);
        }
        
        if($price_from){
            $this->db->where(array('price >=' => $price_from));
        }
        
        if($price_to){
            $this->db->where(array('price <=' => $price_to));
        }
        
        if($keyword){
            $this->db->or_like(array('title' => $keyword, 'description' => $keyword));
        }
        
        $this->db->group_by('id');
        $this->db->order_by($order_by);
        $this->db->limit($perpage, $page);
        
        $output = $this->db->get()->result_array();
        
        return $output;
    }
    
    public function CountRowWithFilter($keyword = '', $category_id = null, $brand_id = null, $price_from = null, $price_to = null){
        $this->db->select('*');
        $this->db->from(self::DB_TABLE);
        $this->db->join('product_cate', self::DB_TABLE.'.id = product_cate.product_id', 'left');

        if($brand_id){
            $this->db->where('brand_id', $brand_id);
        }
        
        if($category_id){
            $this->db->where('category_id', $category_id);
        }
        
        if($price_from){
            $this->db->where(array('price >=' => $price_from));
        }
        
        if($price_to){
            $this->db->where(array('price <=' => $price_to));
        }
        
        if($keyword){
            $this->db->or_like(array('title' => $keyword, 'description' => $keyword));
        }
        
        $this->db->group_by('id');
        
        $output = $this->db->get()->num_rows();
        
        return $output;
    }
}