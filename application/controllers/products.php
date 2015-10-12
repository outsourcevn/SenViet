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
                ->get('category')
                ->row_object();
            $categoryId = 1;
            $data['seo']['title'] = 'Sản phẩm';

            //Pagination
            $config = $this->mypagination->get_config();
            $config['base_url']     = '/san-pham/?show';
            $config['first_url']    = '/san-pham/?show';
            $config['total_rows'] = $this->db
                ->where('publish', 1)
                ->get('products')
                ->num_rows();

            $page                   = $this->input->get('per_page');
            $page                   = ($page < 0) ? $page = 0 : $page;
            $page                   = ($page >= $config['total_rows']) ? 0 : $page;
            $config['cur_page']     = $page;
            $config['per_page'] = $data['configuration']->perpage;
            $config['page_query_string'] = TRUE;
            $this->pagination->initialize($config);

            $data['product_list'] = $this->db
                ->where('publish', 1)
                ->order_by('order', 'ASC')
                ->order_by('created_date', 'DESC')
                ->limit($config['per_page'], $page)
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

                $data['product_list'] = $this->db->select('*')
                    ->where('category_id', $categoryId)
                    ->where('publish', 1)
                    ->get('products')
                    ->result_object();

                $config = $this->mypagination->get_config();
                $config['base_url']     = '/san-pham/'.$alias.'?show';
                $config['first_url']    = '/san-pham/'.$alias.'?show';
                $config['total_rows'] = $this->db
                    ->from('products')
                    ->join('product_cate', 'products.id = product_cate.product_id', 'left')
                    ->where('publish', 1)
                    ->where('product_cate.category_id', $category->id)
                    ->group_by('products.id')
                    ->order_by('order', 'ASC')
                    ->order_by('created_date', 'DESC')
                    ->get()->num_rows();

                $page                   = $this->input->get('per_page');
                $page                   = ($page < 0) ? $page = 0 : $page;
                $page                   = ($page >= $config['total_rows']) ? 0 : $page;
                $config['cur_page']     = $page;
                $config['per_page'] = $data['configuration']->perpage;
                $config['page_query_string'] = TRUE;
                $this->pagination->initialize($config);

                $data['product_list'] = $this->db
                    ->from('products')
                    ->join('product_cate', 'products.id = product_cate.product_id', 'left')
                    ->where('publish', 1)
                    ->where('product_cate.category_id', $category->id)
                    ->group_by('products.id')
                    ->order_by('order', 'ASC')
                    ->order_by('created_date', 'DESC')
                    ->limit($config['per_page'], $page)
                    ->get()
                    ->result_object();

            } else {
                redirect('/');
            }
        }

        //View
        $data['breadcrumb'] = $this->db->where('lft <=', $category->lft)->where('rgt >=', $category->rgt)->get('category')->result_object();
        $data['category_list']      = $this->db->where('publish', 1)->order_by('lft', 'ASC')->get('category')->result_object();
        $data['cur_category']       = $category;
        $data['pagination'] = $this->pagination->create_links();
        $data['tpl']                = 'frontend/products/category';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}