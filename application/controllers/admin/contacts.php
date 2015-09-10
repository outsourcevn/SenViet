<?php
class Contacts extends CI_Controller{
    var $auth;

    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());


        $this->load->model('backend/model_contact', 'Mcontact');
    }

    public function index($page = 0)
    {
        if($this->input->post('cmd') == 'search'){
            $keyword = $this->input->post('keyword');
            redirect(current_url().'/?keyword='.$keyword);
        }

        //Define default value
        $keyword = $this->input->get('keyword');
        $to      = $this->input->get('to');
        $redir   = $this->input->get('redir');

        //Process Delete a list
        if($this->input->post('cmd') == 'delete'){
            $id_arr = $this->input->post('id');

            if($this->Mcontact->delete($id_arr)){
                $this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/contacts/');
            }else{
                $this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/contacts/':base64_decode($redir));
            }
        }

        //Process to show a list
        if($this->input->post('cmd') == 'show'){
            $id_arr = $this->input->post('id');

            if($this->Mcontact->toggle_item('seen', $id_arr)){
                $this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/contacts/':base64_decode($redir));
            }else{
                $this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/contacts/':base64_decode($redir));
            }

        }


        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }
        if($to == 0 || $to == ''){
            $param = null;
        } else {
            $param = array('to' => $to);
        }

        //Pagination
        $config = $this->mypagination->get_config();
        $config['base_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/contacts/index/');
        $config['first_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/contacts/index/').'?'.$_SERVER['QUERY_STRING'];
        $config['total_rows'] = $this->Mcontact->CountRow($keyword, $param);
        $config['cur_page'] = ($page >= 0) ? $page : 0;
        $perpage = CMS_ITEM_PER_PAGE;
        $config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
        $this->pagination->initialize($config);

        //Data to transport
        $data['input_data']= $this->Mcontact->SelectByX($param, $keyword, $order_by, $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword'] = $keyword;
        $data['to'] = $to;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/contacts/home';
        $this->load->view('backend/layout/home', $data);
    }

    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(is_numeric($id)){
            if($this->Mcontact->SelectByID($id)){
                $this->Mcontact->delete($id);
                $this->mycommonlib->redir_alert('Xóa tin nhắn thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/contacts/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/contacts/');
            }

        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/contacts/');
        }
    }

    public function contact_toogle($field = 'seen', $id = 1){
        $allow_arr = array('seen');
        $redir = $this->input->get('redir');

        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
        else {
            if(!$this->Mcontact->toggle_item($field, $id)){
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/contacts/':base64_decode($redir));
            }else{
                $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/contacts/':base64_decode($redir));
            }
        }
    }

    public function view($id = null){
        $redir = $this->input->get('redir');

        if($this->input->post('cmd') == 'viewed') {
            $this->Mcontact->ModifyRow(array('seen' => 1) , $id);
        }

        if($this->input->post('cmd') == 'unview') {
            $this->Mcontact->ModifyRow(array('seen' => 0) , $id);
        }

        $data['post_data'] = $this->Mcontact->SelectByID($id);

        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/contacts/view';
        $data['redir'] = $redir;
        $this->load->view('backend/layout/home', $data);
    }
}