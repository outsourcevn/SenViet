<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_detail extends CI_Controller{

    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index($alias = '')
    {
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_product';

        $alias = $this->uri->uri_string();
        $alias = str_replace('.html', '', $alias);
        $alias = str_replace('san-pham/', '', $alias);

        if($this->db->where('alias', $alias)->where('publish', 1)->get('products')->num_rows() == 0){
            redirect('/');
            die();
        }

        $data['cur_product'] = $this->db->where('alias', $alias)->where('publish', 1)->get('products')->row_object();


        $categoryId = $this->db->where('product_id', $data['cur_product']->id)
            ->get('product_cate')->row_object()->category_id;
        $category = $this->db
            ->where('id', $categoryId)->get('category')->row_object();

        //View
        //Related Product
        $data['featured_products'] = $this->db->where('publish', 1)->where('is_featured', 1)->order_by('rand()')->limit(10)->get('products')->result_object();

        $data['breadcrumb'] = $this->db->where('lft <=', $category->lft)->where('rgt >=', $category->rgt)->get('category')->result_object();
        $data['category_list']      = $this->db->where('publish', 1)->order_by('lft', 'ASC')->get('category')->result_object();
        $data['cur_category']       = $category;
        $data['pagination'] = $this->pagination->create_links();
        $data['seo']['title'] = $data['cur_product']->title;
        $data['seo']['meta_description'] = $data['cur_product']->meta_description;
        $data['seo']['meta_keywords'] = $data['cur_product']->meta_keyword;

        $data['tpl']                = 'frontend/products/product';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}