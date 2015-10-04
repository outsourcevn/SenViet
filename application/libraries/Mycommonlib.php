<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Mycommonlib {
    
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    /**
     * Redirect to URL and show out a alert
     * @param string
     * @param string
     **/
    public function redir_alert($alert = '', $uri = ''){
        echo '<meta charset="utf-8"/>';
        if(preg_match('/http:\/\//', $uri)){
        	echo '<script>alert("'.$alert.'"); location.href="'.$uri.'";</script>';
        }
        else{
        	echo '<script>alert("'.$alert.'"); location.href="'.CMS_BASE_URL.'/'.$uri.'";</script>';
        }
    }
    
    
    
    /**
     * Filter fields that allowed
     * @param array
     * @param array
     * @return Array that was filtered
     **/
    public function Filter_Field($input, $fields){
        /** TESTED OK **/
        foreach($input as $key => $val){
            if(!in_array($key, $fields)){
                unset($input[$key]);
            }
            else{
                if(is_string($input[$key])){
                    $input[$key] = htmlspecialchars($input[$key]);
                }
            }
        }
        
        return $input;
    }
    
    public function vn2latin($cs, $tolower = false)
    {
        $cs = str_replace(':', '', $cs);
        $cs = str_replace('?', '', $cs);
        $cs = str_replace('<', '', $cs);
        $cs = str_replace('>', '', $cs);
        $cs = str_replace('^', '', $cs);

        $cs = trim($cs);

        /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
        $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
        "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
        "ế","ệ","ể","ễ",
        "ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
        "ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
        "Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ"," ");
         
        /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
        $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
        "a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o",
        "o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A",
        "A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","-");
         
        if ($tolower) {
            return strtolower(str_replace($marTViet,$marKoDau,$cs));
        }

        return str_replace($marTViet,$marKoDau,$cs);
    }
}