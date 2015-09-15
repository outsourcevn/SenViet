<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
    var $auth;

    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());


        $this->load->model('backend/model_news', 'Mnews');
        $this->load->model('backend/model_category_news', 'Mcategory');
    }

    public function index($page = 0)
    {
        //Define default value
        $keyword        = $this->input->get('keyword');
        $redir          = $this->input->get('redir');
        $category_id    = $this->input->get('category_id');
        $perpage        = CMS_ITEM_PER_PAGE;

        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        $field = $this->input->get('field');
        $direction = $this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }

        //Sorting a list Items
        if($this->input->post('cmd') == 'sort'){
            $id_arr = $this->input->post('order');

            if($this->Mnews->SortItems($id_arr)){
                $this->mycommonlib->redir_alert('Sắp xếp thành công!',CMS_DEFAULT_BACKEND_URL.'/news/');
            }else{
                $this->mycommonlib->redir_alert('Sắp xếp thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
            }
        }

        //Process Delete a list
        if($this->input->post('cmd') == 'delete'){
            $id_arr = $this->input->post('id');

            if($this->Mnews->delete($id_arr)){
                $this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/news/');
            }else{
                $this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
            }
        }

        //Process to show a list
        if($this->input->post('cmd') == 'show'){
            $id_arr = $this->input->post('id');

            if($this->Mnews->toggle_item('publish', $id_arr)){
                $this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
            }else{
                $this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
            }

        }

        //Pagination
        $config = $this->mypagination->get_config();
        $config['base_url']     = base_url(CMS_DEFAULT_BACKEND_URL.'/news/index');
        $config['first_url']    = base_url(CMS_DEFAULT_BACKEND_URL.'/news/index').'?'.$_SERVER['QUERY_STRING'];
        $config['total_rows']   = $this->Mnews->CountRowWithFilter($keyword, $category_id);
        $config['per_page']     = CMS_ITEM_PER_PAGE;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
        $config['cur_page'] = $page;
        $config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
        $this->pagination->initialize($config);

        //Data to transport
        //$data['list_category']  = $this->Mcategory->SelectByX(null, null, 'lft ASC');
        $this->load->library('my_nestedset');
        $data['list_category']      = $this->my_nestedset->dropdown('category_news');
        $data['input_data'] = $this->Mnews->SelectDataWithFilter($keyword, $category_id, $order_by,
            $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword']            = $keyword;
        $data['category_id']        = $category_id;
        $data['field']              = $field;
        $data['direction']          = $direction;
        $data['auth']               = $this->auth;
        $data['tpl']                = 'backend/news/home';
        $this->load->view('backend/layout/home', $data);
    }

    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(is_numeric($id)){
            if($this->Mnews->SelectByID($id)){
                $this->Mnews->delete($id);
                $this->mycommonlib->redir_alert('Xóa tin tức thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/news/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/news/');
            }

        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/news/');
        }
    }

    public function news_toogle($field = 'publish', $id = 1){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');

        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
        }

        if(!$this->Mnews->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/news/':base64_decode($redir));
        }
    }

    public function add(){
        if($this->input->post()){
            $data['post_data'] = $this->input->post();

            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('description', 'Mô tả ngắn', 'trim|required|min_length[20]');
            $this->form_validation->set_rules('content', 'Nội dung', 'required|min_length[50]');
            $this->form_validation->set_rules('thumbnail', 'Ảnh đại diện', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Danh mục', 'required|is_numeric');
            $this->form_validation->set_rules('alias', 'Alias', 'callback__exist_alias');

            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');


            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field(
                    $data['post_data'],
                    array('title',
                        'content',
                        'description',
                        'thumbnail',
                        'alias',
                        'meta_description',
                        'meta_keyword',
                        'meta_title',
                        'publish',
                        'is_featured',
                        'thumbnail',
                        'category_id'
                    )
                );

                $this->Mnews->InsertNewItem($data['post_data'], $this->auth['id']);


                $this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/news/');
            }
        }

        $data['category_list']      = $this->Mcategory->SelectByX();

        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/news/add';
        $this->load->view('backend/layout/home', $data);
    }

    public function edit($id = null){

        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(!$this->Mnews->SelectByID($id) || !is_numeric($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/news/');
        }

        $raw_data = (array)$this->Mnews->SelectByID($id);

        if($this->input->post()){
            $data['post_data'] = $this->input->post();

            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('description', 'Mô tả ngắn', 'trim|required|min_length[20]');
            $this->form_validation->set_rules('content', 'Nội dung', 'required|min_length[50]');
            $this->form_validation->set_rules('thumbnail', 'Ảnh đại diện', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Danh mục', 'required|is_numeric');
            $this->form_validation->set_rules('alias', 'Alias', 'callback__exist_alias['.$raw_data['alias'].']');

            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');

            if($this->form_validation->run() == TRUE){

                $data['post_data'] = $this->mycommonlib->Filter_Field(
                    $data['post_data'],
                    array('title',
                        'content',
                        'description',
                        'thumbnail',
                        'alias',
                        'meta_description',
                        'meta_keyword',
                        'meta_title',
                        'publish',
                        'is_featured',
                        'thumbnail',
                        'category_id'
                    )
                );

                $this->Mnews->ModifyRow($data['post_data'], $id);

                $this->mycommonlib->redir_alert('Thay đổi thông tin bài đăng thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/news/');
            }
        }else{
            $data['post_data'] = $raw_data;
        }

        //Lay du lieu category tu POST hoac Mysql
        $data['post_data']['category_id']  = (isset($data['post_data']['category_id'])) ?
            $data['post_data']['category_id'] : 0;

        $data['category_list']      = $this->Mcategory->SelectByX();
        $data['auth']               = $this->auth;
        $data['tpl'] = 'backend/news/edit';
        $this->load->view('backend/layout/home', $data);
    }
    

    public function ajax_alias($str = ''){  //MODE == 1 -> Return Bool   == 0 echo OUTPUT
        $mode = 1;

        if($str == ''){
            $mode = 0;
            $str = $this->input->post('str');
            $str = $this->mycommonlib->vn2latin($str, true);
        }

        $count = $this->db->like('alias', "$str", 'none')->get('tin tứcs')->num_rows() + 1;
        if($count > 1)
            $output =  $str . '-' . $count;
        else{
            $output = $str;
        }

        if($mode)
            return $output;

        echo $output;
    }

    public function _exist_alias($str, $oldAlias = null){

        if($oldAlias != null){
            if($str == $oldAlias)
                return true;
        }

        if($str != '')
            return true;

        $data = $this->Mnews->SelectByX(array('alias' => $str));
        if(count($data) > 0){
            $this->form_validation->set_message('_exist_alias', 'Alias bạn nhập đã có trong CSDL.');
            return false;
        }else{
            return true;
        }
    }
}

