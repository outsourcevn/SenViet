<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {
    var $auth;

    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());


        $this->load->model('backend/model_faq', 'Mfaq');
    }

    public function index($page = 0)
    {
        if($this->input->post('cmd') == 'search'){
            $keyword = $this->input->post('keyword');
            redirect(current_url().'/?keyword='.$keyword);
        }

        //Define default value
        $keyword = $this->input->get('keyword');
        $redir   = $this->input->get('redir');

        //Process Delete a list
        if($this->input->post('cmd') == 'delete'){
            $id_arr = $this->input->post('id');

            if($this->Mfaq->delete($id_arr)){
                $this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/faq/');
            }else{
                $this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/faq/':base64_decode($redir));
            }
        }

        //Process to show a list
        if($this->input->post('cmd') == 'show'){
            $id_arr = $this->input->post('id');

            if($this->Mfaq->toggle_item('publish', $id_arr)){
                $this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/faq/':base64_decode($redir));
            }else{
                $this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/faq/':base64_decode($redir));
            }

        }


        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }

        //Pagination
        $config = $this->mypagination->get_config();
        $config['base_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/faq/index/');
        $config['first_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/faq/index/').'?'.$_SERVER['QUERY_STRING'];
        $config['total_rows'] = $this->Mfaq->CountRow($keyword);
        $config['cur_page'] = ($page >= 0) ? $page : 0;
        $perpage = CMS_ITEM_PER_PAGE;
        $config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
        $this->pagination->initialize($config);

        //Data to transport
        $data['input_data']= $this->Mfaq->SelectByX(null, $keyword, $order_by, $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword'] = $keyword;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/faq/home';
        $this->load->view('backend/layout/home', $data);
    }

    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(is_numeric($id)){
            if($this->Mfaq->SelectByID($id)){
                $this->Mfaq->delete($id);
                $this->mycommonlib->redir_alert('Xóa người dùng thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/faq/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/faq/');
            }

        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/faq/');
        }
    }

    public function faq_toggle($field = 'publish', $id = 1){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');

        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }

        if(!$this->Mfaq->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/faq/':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/faq/':base64_decode($redir));
        }
    }

    public function add(){

        if($this->input->post()){
            $data['post_data'] = $this->input->post();

            $this->form_validation->set_rules('question', 'Câu hỏi', 'required');
            $this->form_validation->set_rules('question', 'Câu trả lời', 'required');

            $this->form_validation->set_message('required', '%s không được để trống.');

            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('question', 'answer','publish'));
                $this->Mfaq->InsertNewItem($data['post_data']['question'], $data['post_data']['answer'], $data['post_data']['publish']);
                $this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/faq');
            }
        }

        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/faq/add';
        $this->load->view('backend/layout/home', $data);
    }

    public function edit($id = null){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        $data['post_data'] = $this->Mfaq->SelectByID($id);

        if(!is_numeric($id) || !$data['post_data'])
        {
            $this->mycommonlib->redir_alert('Trang bạn vừa nhập không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/faq/');
        }

        $data['post_data'] = (array)$data['post_data'];

        if($this->input->post()){
            $data['post_data'] = $this->mycommonlib->Filter_Field($this->input->post(), array('question', 'answer','publish'));

            $this->form_validation->set_rules('question', 'Câu hỏi', 'required');
            $this->form_validation->set_rules('question', 'Câu trả lời', 'required');

            $this->form_validation->set_message('required', '%s không được để trống.');

            if($this->form_validation->run() == TRUE){
                $this->Mfaq->ModifyRow($data['post_data'], $id);
                $this->mycommonlib->redir_alert('Sửa thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/faq/');
            }
        }

        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/faq/edit';
        $this->load->view('backend/layout/home', $data);
    }
}