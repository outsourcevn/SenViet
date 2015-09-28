<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller{

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


        if($alias == ''){
            $category = $this->db
                ->where('id', 1)
                ->where('publish', 1)
                ->get('category')
                ->row_object();
            $categoryId = 1;
            $data['seo']['title'] = 'Sản phẩm';

            $data['product-list'] = $this->db
                ->where('publish', 1)
                ->get('products')
                ->result_object();

        } else {
            $category = $this->db
                ->where('alias', $alias)
                ->where('publish', 1)
                ->get('category')
                ->row_object();

            if(count($category) === 1){
                $categoryId = $category->id;
                $data['seo']['title'] = $category->title;
                $data['seo']['description'] = $category->description;
                $data['seo']['keywords'] = $category->meta_keywords;

                $data['product-list'] = $this->db
                    ->where('category_id', $categoryId)
                    ->where('publish', 1)
                    ->get('products')
                    ->result_object();
            } else {
                redirect('/');
            }
        }

        //View
        $data['breadcrumb'] = $this->db->where('lft <=', $category->lft)->where('rgt >=', $category->rgt)->get('category')->result_object();


        $data['tpl']                = 'frontend/products/category';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}