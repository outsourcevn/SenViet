<?php
class News extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_category', 'Mcategory');
        $this->load->model('frontend/model_products', 'Mproduct');
        $this->load->model('frontend/model_slide', 'Mslide');
        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index($route)
    {
        $alias = $this->uri->uri_string();
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_news';

        $rs = $this->db->where('alias', $alias)->where('publish', 1)->get('category_news');

        if($rs->num_rows() == 1) {

            $data['cur_category'] = $rs->row_object();

            $data['breadcrumb'] = $this->db->where('lft <=', $data['cur_category']->lft)->where('rgt >=', $data['cur_category']->rgt)->get('category_news')->result_object();

            $parentId = $data['cur_category']->parentid;
            if($data['cur_category']->level >= 3) {
                $data['list_left_category'] = $this->db
                    ->where('parentid', $parentId)
                    ->where('publish', 1)
                    ->get('category_news')
                    ->result_object();
            } else {
                $data['list_left_category'] = $this->db
                    ->where('parentid', $data['cur_category']->id)
                    ->where('publish', 1)
                    ->get('category_news')
                    ->result_object();
            }

            $data['list_post'] = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->get('news')
                ->result_object();

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