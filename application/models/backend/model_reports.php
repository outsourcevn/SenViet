<?php
class Model_reports extends CI_Model{
    public function getBestSelling($from = null, $to = null, $limit = 10){
        $from   = date('Y-m-d H:i:s', strtotime($from.'00:00:00'));
        $to     = date('Y-m-d H:i:s', strtotime($to.'23:59:59'));
        
        $sql    = "SELECT SUM(`cms_order_details`.`quantity`) as `DEM`, `cms_products`.`title` FROM `cms_order_details` JOIN `cms_orders` ON `cms_order_details`.`order_id` = `cms_orders`.`id` JOIN `cms_products` ON `cms_products`.`id` = `cms_order_details`.`product_id` WHERE `cms_orders`.`status` = 2 AND `cms_orders`.`created_date` >= '$from' AND `cms_orders`.`created_date` <= '$to' GROUP BY `product_id` ORDER BY `DEM` DESC LIMIT $limit";
        
        $row    = $this->db->query($sql);
        return $row->result_array();
    }
    
    public function getBestRevenues($from = null, $to = null, $limit = 10){
        $from   = date('Y-m-d H:i:s', strtotime($from.'00:00:00'));
        $to     = date('Y-m-d H:i:s', strtotime($to.'23:59:59'));
        
        $sql    = "SELECT SUM(`cms_order_details`.`price` * `cms_order_details`.`quantity`) as `TIEN`, `cms_products`.`title` FROM `cms_order_details` JOIN `cms_orders` ON `cms_order_details`.`order_id` = `cms_orders`.`id` JOIN `cms_products` ON `cms_products`.`id` = `cms_order_details`.`product_id` WHERE `cms_orders`.`status` = 2 AND  `cms_orders`.`created_date` >= '$from' AND `cms_orders`.`created_date` <= '$to' GROUP BY `product_id` ORDER BY `TIEN` DESC LIMIT $limit";
        
        $row    = $this->db->query($sql);
        return $row->result_array();
    }
}
