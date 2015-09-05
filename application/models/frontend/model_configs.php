<?php

class Model_configs extends CI_Model{
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
     
     public function get_Configs(){
        return $this->db->get('configs')->row_object();
     }
}