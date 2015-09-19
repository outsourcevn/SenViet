<?php
class Npp extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_category', 'Mcategory');
        $this->load->model('frontend/model_products', 'Mproduct');
        $this->load->model('frontend/model_slide', 'Mslide');
        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index()
    {
        $alias = $this->uri->uri_string();
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_npp';

        $rs = $this->db->where('alias', $alias)->where('publish', 1)->get('category_news');

        if($rs->num_rows() == 1) {

            $data['cur_category'] = $rs->row_object();

            $data['breadcrumb'] = $this->db->where('lft <=', $data['cur_category']->lft)->where('rgt >=', $data['cur_category']->rgt)->get('category_news')->result_object();

            /**LEFT COLMN*/
            $parentId = $data['cur_category']->parentid;
            if($data['cur_category']->level >= 3) {
                $data['list_left_category'] = $this->db
                    ->where('parentid', $parentId)
                    ->where('publish', 1)
                    ->order_by('lft', 'ASC')
                    ->get('category_news')
                    ->result_object();
            } else {
                $data['list_left_category'] = $this->db
                    ->where('parentid', $data['cur_category']->id)
                    ->where('publish', 1)
                    ->order_by('lft', 'ASC')
                    ->get('category_news')
                    ->result_object();
            }

            $data['featuredProducts'] = $this->db
                ->where('publish', 1)
                ->where('is_featured', 1)
                ->order_by('order', 'ASC')
                ->order_by('created_date', 'DESC')
                ->get('products')
                ->result_object();
            /** END LEFT COLUMN*/

            $totalRows = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->get('news')->num_rows();

            //Pagination
            $config = $this->mypagination->get_config();
            $config['base_url']     = base_url($alias).'/?show';
            $config['first_url']    = base_url($alias).'/?show';
            $config['total_rows']   = $totalRows;
            $config['per_page']     = $this->configs->perpage;
            $page                   = $this->input->get('per_page');
            $page                   = ($page < 0) ? $page = 0 : $page;
            $page                   = ($page >= $config['total_rows']) ? 0 : $page;
            $config['cur_page']     = $page;
            $config['page_query_string'] = TRUE;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $data['list_post'] = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->order_by('order', 'ASC')
                ->order_by('created_date', 'desc')
                ->limit($this->configs->perpage, $page)
                ->get('news')->result_object();

        } else {
            redirect('/');
        }

        //View
        $data['tpl']                = 'frontend/news/home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}