<?php
class News_detail extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }
    public function index(){
        $alias = $this->uri->uri_string();
        $alias = substr($alias, 0, strpos($alias, '.html'));
        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_news';
        if(preg_match('/dao-tao/', $alias))
        {
            $data['active_nav'] = 'nav_training';
        } else if(preg_match('/thong-tin-npp/', $alias)) {
            $data['active_nav'] = 'nav_npp';
        }

        $rs = $this->db->where('alias', $alias)->where('publish', 1)->get('news');

        if($rs->num_rows() == 1) {
            $data['cur_news'] = $rs->row_object();
            $data['cur_category'] = $this->db->where('id', $data['cur_news']->category_id)->where('publish', 1)->get('category_news')->row_object();

            $data['breadcrumb'] = $this->db->where('lft <=', $data['cur_category']->lft)->where('rgt >=', $data['cur_category']->rgt)->get('category_news')->result_object();


            /**Related Information*/
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

            $data['relatedNews'] = $this->db
                ->where('id !=', $data['cur_news']->id)
                ->where('category_id', $data['cur_category']->id)
                ->where('publish', 1)
                ->order_by('created_date', 'DESC')
                ->limit(5)
                ->get('news')
                ->result_object();

            $data['featuredProducts'] = $this->db
                ->where('publish', 1)
                ->where('is_featured', 1)
                ->order_by('created_date', 'DESC')
                ->get('products')
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
        $data['tpl']                = 'frontend/news/news_detail';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}