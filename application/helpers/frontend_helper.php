<?php

if(!function_exists('get_image_list')){
	function get_image_list($pro_id, $featured_image = false){
		$CI =&get_instance();
        
        if($featured_image){
            $data = $CI->db->where('FK_id', $pro_id)->where('featured_images', 1)->get('images')->row_object();
        }else{
            $data = $CI->db->where('FK_id', $pro_id)->get('images')->result_object();
        }
        //
        return $data;
	}
}

if(!function_exists('get_thumbnail_image')){
    function get_thumbnail_image($pro_id){
        $CI = &get_instance();
        
        $data = $CI->db->where('FK_id', $pro_id)->order_by('main_image', 'DESC')->get('images')->row_object();
        
        return $data;
    }
}

if(!function_exists('Get_resize_image_link')){
    function Get_resize_image_link($link, $width, $height){
        if(preg_match('/http:\/\/(.*)$/', $link) || preg_match('/https:\/\/(.*)$/', $link)){
            return $link;
        }else{
            if($link[0] == '/'){
                return "resizeimage/index/?link=".substr($link, 1, strlen($link))."&max_width=$width&max_height=$height";
            }else{
                return "resizeimage/index/?link=$link&max_width=$width&max_height=$height";
            }
        }
    }
}


if(!function_exists('CountItemInCategory')){
    function CountItemInCategory($cate_id = 0){
        $CI = &get_instance();
        
        return $CI->db->where('category_id', $cate_id)->get('product_cate')->num_rows();
    }
}

if(!function_exists('ProductListInCate')){
    function ProductListInCate($cate_id = null, $limit = 4){
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('products');
        $CI->db->join('product_cate', 'products.id = product_cate.product_id');
        $CI->db->where('publish', 1);
        $CI->db->where('category_id', $cate_id);
        $CI->db->group_by('id');
        $CI->db->order_by('order', 'ASC');
        $CI->db->order_by('id', 'DESC');
        $CI->db->limit($limit);
        
        return $CI->db->get()->result_object();
    }
}

//LAY CATEGORY HIEN TAI VA CAC CATEGORY CON
if(!function_exists('CurentCategory')){
    function CurentCategory($cate_id){
        $CI = &get_instance();
        
        $cur_cate = $CI->db->where('id', $cate_id)->get('category')->row_array();
        $data = $CI->db->where('lft >=', $cur_cate['lft'])->where('rgt <=', $cur_cate['rgt'])->order_by('lft')->get('category')->result_array();
        return $data;
    }
}

if(!function_exists('GenerateCategoryList')){
    function GenerateCategoryList($data, $start = 0){
        foreach($data as $key => $val){
            if($val['lft'] == $val['rgt']-1){
                if($val['parentid'] == $start){
                    $str = '<li class="clearfix';
                    
                    if($val['alias'] == uri_string()){
                        $str .= ' active ';
                    }
                    
                    $str .= '"><a href="category/'.$val['alias'].'">';
                    
                    $str .= $val['title'] .'</a></li>';
                    
                    echo $str;
                }
            }else{
                if($val['parentid'] == $start){
                    //echo '';
                    
                    $str = '<li class="clearfix;';
                    
                    if($val['alias'] == uri_string()){
                        $str .= ' active ';
                    }
                    
                    $str .= '"><a href="category/'.$val['alias'].'">';
                    
                    $str .= $val['title'] .'</a>';
                    echo $str;
                    echo '<ul>';
                    
                    GenerateCategoryList($data, $val['id']);
                    
                    echo '</ul></li>';
                }
            }
        }
    }
}

if(!function_exists('CountItemsOnCart')){
    function CountItemsOnCart(){
        $CI = &get_instance();
        if(!is_array($CI->session->userdata('cart')))
            return 0;
        
        return count($CI->session->userdata('cart'));
    }
}