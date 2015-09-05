<?php
if(!function_exists('get_usergroup')){
	function get_usergroup($id){
		$CI =&get_instance();
        
        $group = $CI->db->where('id', $id)->get('usergroup')->row_array();
        return $group['title'];
	}
}

if(!function_exists('get_sort_link')){
	/**
     * Generate sort link
     * @param string
     * @param string
     * @param string
     * @param string ASC/DESC
     * @param Array
     * @return String
     **/
    function get_sort_link($uri = '', $title = 'ID', $field = 'id', $attr ='', $param = array()){
        
        $direct = 'DESC';
        $def_field = 'id';
        
        if(isset($_GET['field']))
        	$def_field = $_GET['field'];
        
        if($def_field == $field){
        	
			if(isset($_GET['direction'])){
        		$direct = $_GET['direction'];
        	}
        	
            $direct = ($direct == 'ASC') ? 'DESC' : 'ASC';
        }else{
        	$direct = 'ASC';
        }
        
        $link = $uri.'/?field='.$field.'&direction='.$direct;
        
        if(count($param) && $param != null){
            foreach($param as $key => $val){
                $link .= '&'.$key.'='.$val;
            }
        }
        
        $link = base_url($link);
        
        if($def_field == $field)
        {
        	if($direct == 'ASC'){
	            $output = '<a href="'.$link.'" '.$attr.'>'.$title.' <span class="glyphicon glyphicon glyphicon-chevron-down"></span></a>';
	        }
	        else{
	            $output = '<a href="'.$link.'" '.$attr.'>'.$title.' <span class="glyphicon glyphicon glyphicon-chevron-up"></span></a>';
	        }
        }else{
        	if($direct == 'ASC'){
	            $output = '<a href="'.$link.'" '.$attr.'>'.$title.'</a>';
	        }
	        else{
	            $output = '<a href="'.$link.'" '.$attr.'>'.$title.'</a>';
	        }
        }
        
        return $output;
    }
}

if(!function_exists('get_username_by_id')){
	
	function get_username_by_id($id = 1){
		$CI =&get_instance();
		$CI->load->model('backend/model_user', 'Muser');
		if($user = $CI->Muser->SelectByID($id)){
			return $user->username;
		}else{
			return '-';
		}
	}
}

if(!function_exists('count_user_in_group')){
	
	function count_user_in_group($id = 1){
		$CI =&get_instance();
		return $CI->db->where('usergroupid', $id)->get('username')->num_rows();
	}
}

if(!function_exists('Generate_Select_Menu')){
	/**
     * Create Selection Menu
     **/
     function Generate_Select_Menu($name = 'Select', $default_title = 'Select One', $default_vaule = 0, $param = array(), $selected_item = null, $select_val = 'id', $select_title = 'title', $html_id = '', $class = 'form-control'){
     	$str = '<select name="'.$name.'" class = "'.$class.'">
		 	<option value="'.$default_vaule.'">'.$default_title.'</option>
			 ';
		foreach($param as $key => $val){
			$selected = ($selected_item == $val[$select_val]) ? 'selected' : '';
			$str .= '<option '.$selected.' value="'.$val[$select_val].'">'.$val[$select_title].'</option>
			';
		}
		$str .='</select>';
		return $str;
     }
}

if(!function_exists('GenerateCategoryCheckList')){
    function GenerateCategoryCheckList($data, $start = 0, $curent_category_id = null){
        foreach($data as $key => $val){
            if($val['lft'] == $val['rgt']-1){
                if($val['parentid'] == $start){
                    $str = '<li><label><input type="checkbox" name="category_id[]" value="'.$val['id'].'" ';
                    
                    if(isset($curent_category_id) && in_array($val['id'] ,$curent_category_id)){
                        $str .= 'checked';
                    }
                    
                    $str .= ' /> '. $val['title'] .'</label></li>';
                    
                    echo $str;
                }
            }else{
                if($val['parentid'] == $start){
                    //echo '';
                    
                    $str = '<li><label><input type="checkbox" name="category_id[]" value="'.$val['id'].'" ';
                    
                    if(isset($curent_category_id) && in_array($val['id'] ,$curent_category_id)){
                        $str .= 'checked';
                    }
                    
                    $str .= ' /> '. $val['title'] .'</label>';
                    echo $str;
                    echo '<ul>';
                    
                    GenerateCategoryCheckList($data, $val['id'], $curent_category_id);
                    
                    echo '</ul></li>';
                }
            }
        }
    }
}

/**
 * Ham nay su dung de chuyen query tra ve cua CATE_PRODUCT sang mang 1 chieu
 **/
if(!function_exists('ProcessCategory')){
    function ProcessCategory($data){
        $temp = array();
        
        foreach($data as $k => $v){
            $temp[] = $v['category_id'];
        }
        
        return $temp;
    }
}

/**
 * Ham nay su dung de chuyen query image sang array 1 chieu
 **/
if(!function_exists('ProcessImage')){
    function ProcessImage($data){
        $temp = array();
        
        foreach($data as $k => $v){
            $temp[] = $v['image_link'];
        }
        
        return $temp;
    }
}

/**
 * Ham nay su dung de hien thi hinh anh
 */
if(!function_exists('ShowImage')){
    function ShowImage($url){
        $pos = strrpos( $url, ".");
        if ($pos === false)
            return false;

        $ext = strtolower(trim(substr( $url, $pos)));
        $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif"); // this is far from complete but that's always going to be the case...

        if ( in_array($ext, $imgExts) ) {
            if(preg_match('@^(?:http://)?([^/]+)@i', $url) || preg_match('@^(?:https://)?([^/]+)@i', $url)){
                return $url;
            }else{
                $str = CMS_DOMAIN.$url;
                return $str;
            }
        }
    }
}

if(!function_exists('get_product_by_id')){

    function get_product_by_id($id = 1){
        $CI =&get_instance();
        $data = $CI->db->select('*')->where('id', $id)->get('products')->row_object();

        if(isset($data)){
            return (object)$data;
        }
        return '-';
    }
}