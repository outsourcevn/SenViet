<?php

Class Model_orderdetail extends CI_Model{
    const DB_TABLE = 'order_details';
    
    var $order_id;
    var $product_id;
    var $quantity;
    var $price;
    
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
    public function InsertNewItem($InputData = null){
        
        $this->populate($InputData);
        
        $this->db->insert(self::DB_TABLE, $this);
        return $this->db->affected_rows();
    }
    
    /**
     * Return Inserted ID
     **/
     public function inserted_id(){
        return $this->db->insert_id();
     }
    
    public function SelectByOrderID($id){
        
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('order_id', $id);
        $this->db->join(self::DB_TABLE, 'products.id = order_details.product_id');
        
        $data = $this->db->get()->result_object();
        
        if($data){
            return $data;
        }else{
            return false;
        }
    } 
    
    
    /**
     * Delete rows from database
     * @param mixed
     * @return bool
     **/
    public function DeleteByOrderID($id){
        if(is_array($id)){
            $this->db->where_in('order_id', $id)->delete(self::DB_TABLE);
            return true;
        }
        
        if(!is_numeric($id))
            return false;
        
        $this->db->delete(self::DB_TABLE, array('order_id' => $id));
        return true;
        
        /** Tested OK **/
    }
    
    public function DeleteByProductID($id){
        if(!is_numeric($id))
            return false;
        
        $this->db->delete(self::DB_TABLE, array('product_id' => $id));
        return true;
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
     * @param int
     * @return bool
     **/
     public function ModifyRow($NewData, $order_id, $product_id){
        $this->populate($NewData);
         
        $this->db->update(self::DB_TABLE, $this, array('order_id' => $order_id, 'product_id' => $product_id));
        
        return $this->db->affected_rows();
        /** Tested OK **/
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
    /**
     * Den so ban ghi voi dieu kien nhap vao
     **/
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
    
    /**
     * Select orderDetail with ProductID and OrderID
     **/
    public function SelectByOrderIDAndProID($order_id = null, $product_id = null){
        return $this->db->where('order_id', $order_id)->where('product_id', $product_id)->get(self::DB_TABLE)->row_array();
    }
    
    /**
     * Xoa ban ghi theo orderID and ProductID
     **/
    public function DeleteByOrderIDAndProID($order_id = null, $product_id = null){
        $this->db->where('order_id', $order_id)->where('product_id', $product_id)->delete(self::DB_TABLE);
    }
    
    /**
     * Select by ProductID
     * @author minhducck
     * @param Integer
     */
    public function SelectByProID($id = null){
        $this->db->select('*');
        $this->db->select('products.price as ori_price');
        $this->db->from('products');
        $this->db->join(self::DB_TABLE, "products.id = ".self::DB_TABLE.".product_id");
        $this->db->where('product_id', $id);
        
        return $this->db->get()->row_array();
    }
}