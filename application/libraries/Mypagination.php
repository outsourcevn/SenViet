<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Mypagination{
	private $CI;
	
	var $base_url			= ''; // The page we are linking to
	var $prefix				= ''; // A custom prefix added to the path.
	var $suffix				= ''; // A custom suffix added to the path.

	var $total_rows			=  0; // Total number of items (database results)
	var $per_page			= CMS_ITEM_PER_PAGE; // Max number of items you want shown per page
	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
	var $cur_page			=  0; // The current page being viewed
	var $use_page_numbers	= FALSE; // Use page number for segment instead of offset
	var $first_link			= '&lsaquo; Trang đầu';
	var $next_link			= '&gt;';
	var $prev_link			= '&lt;';
	var $last_link			= 'Trang cuối &rsaquo;';
	var $uri_segment		= 3;
	var $full_tag_open		= '<nav><ul class="pagination">';
	var $full_tag_close		= '</ul></nav>';
	var $first_tag_open		= '<li>';
	var $first_tag_close	= '</li>';
	var $last_tag_open		= '<li>';
	var $last_tag_close		= '</li>';
	var $first_url			= ''; // Alternative URL for the First Page.
	var $cur_tag_open		= '<li class="active"><a>';
	var $cur_tag_close		= '</a></li>';
	var $next_tag_open		= '<li>';
	var $next_tag_close		= '</li>';
	var $prev_tag_open		= '<li>';
	var $prev_tag_close		= '</li>';
	var $num_tag_open		= '<li>';
	var $num_tag_close		= '</li>';
	var $page_query_string	= FALSE;
	var $query_string_segment = 'per_page';
	var $display_pages		= TRUE;
	var $anchor_class		= '';
	public function __construct(){
		$this->CI = &get_instance();
	}
	
	public function get_config(){
		return (array)$this;
	}
}