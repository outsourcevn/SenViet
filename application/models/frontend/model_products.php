<?php
Class Model_products extends CI_Model{
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
     * Lay ra san pham noi bat cua tat ca cac Category
     * @author Ta Minh Duc
     * @param int
     * @param string
     * @param int
     **/
    public function SelectFeaturedProducts($limit = CMS_ITEM_PER_PAGE, $OrderBy = '`order` ASC', $cate_id = null){
        if($cate_id == null){
            $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` WHERE `is_featured` = 1 ORDER BY ".$OrderBy." LIMIT ".$limit;
        } else {
            $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` 
                            JOIN `cms_product_cate` 
                            ON `".CMS_DB_PREFIX.self::DB_TABLE."`.`id` = `cms_product_cate`.`product_id` 
                            WHERE `cms_product_cate`.`category_id` = '".$cate_id."'
                            LIMIT $limit
                            ORDER BY $OrderBy;";
        }
        
        $row = $this->db->query($sql);
        return $row->result_object();
    }
    
    /**
     * Ham lay ra  san pham dc mua va xem nhieu nhat
     **/
    public function SelectHotestProducts($limit = CMS_ITEM_PER_PAGE){
        $sql = "SELECT * FROM 
                `".CMS_DB_PREFIX.self::DB_TABLE."`
                JOIN (`cms_order_details`) ON `".CMS_DB_PREFIX.self::DB_TABLE."`.`id` = `".CMS_DB_PREFIX."order_details`.`product_id` 
                GROUP BY (`id`) ORDER BY count(`id`) DESC LIMIT $limit";
        $row = $this->db->query($sql);
        return $row->result_object();
    }
    
    /**
     * Chon ra san pham moi nhat
     **/
    public function SelectLastestProducts($limit = CMS_ITEM_PER_PAGE){
        $sql = "SELECT * FROM `".CMS_DB_PREFIX.self::DB_TABLE."` ORDER BY `id` DESC LIMIT $limit";
        $row = $this->db->query($sql);
        return $row->result_object();
    }
    
    /**
     * Chon ra san pham theo category
     **/
    public function SelectProByCate($cate_id = null, $OrderBy = 'id DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        
    }
    
    /**
     * Chon ra san pham theo duong dan
     **/
    public function FindByAlias($alias = ''){
        $sql = "SELECT * FROM `cms_products` WHERE `alias` = ?;";
        $row = $this->db->query($sql, array($alias));
        
        return $row->row_object();
    }
    
    /**
     * Selecting Data With Filter Condition
     **/
    public function SelectDataWithFilter($keyword = '', $category_id = null, $brand_id = null, $price_from = null, $price_to = null, $order_by = 'ID DESC', $page = 0, $perpage = CMS_ITEM_PER_PAGE){
        $this->db->select('*');
        $this->db->from(self::DB_TABLE);
        $this->db->join('product_cate', self::DB_TABLE.'.id = product_cate.product_id', 'left');
        
        if($brand_id){
            $this->db->where_in('brand_id', $brand_id);
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
        
        if($order_by){
            switch($order_by){
                case "DATE_DESC": 
                    $order_by = 'created_date DESC';
                    break;
                case "DATE_ASC":
                    $order_by = 'created_date ASC';
                    break;
                case "PRICE_DESC":
                    $order_by = '`price` DESC, `sale_price` DESC';
                    break;
                case "PRICE_ASC":
                    $order_by = '`price` ASC, `sale_price` ASC';
                    break;
                default:
                    $order_by = '`ID` DESC';
            }
            
            $this->db->order_by($order_by);
        }
        
        $this->db->limit($perpage, $page);
        
        $output = $this->db->get()->result_object();
        
        return $output;
    }
    
    public function CountRowWithFilter($keyword = '', $category_id = null, $brand_id = null, $price_from = null, $price_to = null){
        $this->db->select('*');
        $this->db->from(self::DB_TABLE);
        $this->db->join('product_cate', self::DB_TABLE.'.id = product_cate.product_id', 'left');

        if($brand_id){
            $this->db->where_in('brand_id', $brand_id);
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