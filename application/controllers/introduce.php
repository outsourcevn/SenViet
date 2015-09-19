<?php
class Introduce extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index()
    {
        $alias = $this->uri->uri_string();
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_introduce';

        $rs = $this->db->where('alias', $alias)->where('publish', 1)->get('category_news');

        if($rs->num_rows() == 1) {

            $data['cur_category'] = $rs->row_object();

            $data['breadcrumb'] = $this->db->where('lft <=', $data['cur_category']->lft)->where('rgt >=', $data['cur_category']->rgt)->get('category_news')->result_object();

            /**LEFT COLMN*/
            $data['introduceNews'] = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->order_by('order', 'ASC')
                ->limit(5)
                ->get('news')
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
        $data['tpl']                = 'frontend/news/introduce_home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }

    public function detail(){
        $alias = $this->uri->uri_string();
        $alias = substr($alias, 0, strpos($alias, '.html'));
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_introduce';

        $rs = $this->db->where('alias', $alias)->where('publish', 1)->get('news');

        if($rs->num_rows() == 1) {
            $data['cur_news'] = $rs->row_object();
            $data['cur_category'] = $this->db->where('id', $data['cur_news']->category_id)->where('publish', 1)->get('category_news')->row_object();

            $data['breadcrumb'] = $this->db->where('lft <=', $data['cur_category']->lft)->where('rgt >=', $data['cur_category']->rgt)->get('category_news')->result_object();


            /**Related Information*/
            $data['introduceNews'] = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->order_by('order', 'ASC')
                ->limit(5)
                ->get('news')
                ->result_object();

            $data['list_post'] = $this->db
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->get('news')
                ->result_object();

            $data['seo']['keywords'] = $data['cur_news']->meta_keyword;
            $data['seo']['description'] = ($data['cur_news']->meta_description != '') ? $data['cur_news']->meta_description : $data['cur_news']->description;
            $data['seo']['title'] = (($data['cur_news']->meta_title != '') ? $data['cur_news']->meta_title : $data['cur_news']->title);

        } else {
            redirect('/');
        }

        //View
        $data['tpl']                = 'frontend/news/introduce_detail';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}