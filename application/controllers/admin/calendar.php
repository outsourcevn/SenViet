<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
    var $auth;
    /** @var $Mcalendar Model_calendar */
    public $Mcalendar;
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());


        $this->load->model('backend/model_calendar', 'Mcalendar');
    }

    public function index($page = 0)
    {
        $keyword        = $this->input->get('keyword');
        $redir          = $this->input->get('redir');
        $perpage        = CMS_ITEM_PER_PAGE;
        $date_form      = $this->input->get('start_time');
        $date_to        = $this->input->get('end_time');
        $categoryId     = $this->input->get('category_id');

        $data['start_time'] = $date_form;
        $data['end_time'] = $date_to;
        $data['category_id'] = $categoryId;

        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        $field = $this->input->get('field');
        $direction = $this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }

        //Process Delete a list
        if($this->input->post('cmd') == 'delete'){
            $id_arr = $this->input->post('id');

            if($this->Mcalendar->delete($id_arr)){
                $this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/calendar/');
            }else{
                $this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
            }
        }

        //Process to show a list
        if($this->input->post('cmd') == 'show'){
            $id_arr = $this->input->post('id');

            if($this->Mcalendar->toggle_item('publish', $id_arr)){
                $this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
            }else{
                $this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
            }

        }

        /** @var $this->Mcalendar Model_calendar */
        $param = null;
        if(isset($date_form) && $date_form != ''){
            $param['start_time >='] = date('Y-m-d H:i:s', strtotime($date_form.'00:00:00'));
        }
        if(isset($date_to) && $date_to != ''){
            $param['end_time <='] = date('Y-m-d H:i:s', strtotime($date_to.'23:59:59'));
        }

        if($categoryId != '' && $categoryId != 0){
            $param['category_id'] = $categoryId;
        }

        //Pagination
        $config = $this->mypagination->get_config();
        $config['base_url']     = base_url(CMS_DEFAULT_BACKEND_URL.'/calendar/index');
        $config['first_url']    = base_url(CMS_DEFAULT_BACKEND_URL.'/calendar/index').'?'.$_SERVER['QUERY_STRING'];
        $config['total_rows']   = $this->Mcalendar->CountRow($keyword, $param);
        $config['per_page']     = $perpage;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
        $config['cur_page'] = $page;
        $config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        //Main Data
        $data['input_data'] = $this->Mcalendar->SelectByX($param, $keyword, $order_by, $page, $perpage);

        //Data to transport
        $data['keyword']= $this->input->get('keyword');


        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/calendar/home';
        $this->load->view('backend/layout/home', $data);
    }

    public function calendar_toggle($field = 'publish', $id){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');

        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
        }

        if(!$this->Mcalendar->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/calendar/':base64_decode($redir));
        }
    }

    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(is_numeric($id)){
            if($this->Mcalendar->SelectByID($id)){
                $this->Mcalendar->delete($id);
                $this->mycommonlib->redir_alert('Xóa thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/calendar/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/calendar/');
            }

        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/calendar/');
        }
    }

    public function add(){
        if($this->input->post()){
            $data['post_data'] = $this->input->post();

            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('start_time', 'Bắt đầu', 'required');
            $this->form_validation->set_rules('end_time', 'Kết thúc', 'required');
            $this->form_validation->set_rules('content', 'Nội dung sự kiện', 'required');
            $this->form_validation->set_rules('category_id', 'Loại lịch', 'is_natural_no_zero');

            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');


            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'start_time', 'end_time', 'content', 'publish', 'category_id'));
                $data['userid_created'] = $this->auth['id'];
                $this->Mcalendar->InsertNewItem($data['post_data'], $this->auth['id']);

                $this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/calendar/');
            }
        }

        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/calendar/add';
        $this->load->view('backend/layout/home', $data);
    }

    public function edit($id){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }

        if(!$this->Mcalendar->SelectByID($id) || !is_numeric($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/calendar/');
        }

        $raw_data = (array)$this->Mcalendar->SelectByID($id);

        if($this->input->post()){
            $data['post_data'] = $this->input->post();

            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('start_time', 'Bắt đầu', 'required');
            $this->form_validation->set_rules('end_time', 'Kết thúc', 'required');
            $this->form_validation->set_rules('content', 'Nội dung sự kiện', 'required');
            $this->form_validation->set_rules('category_id', 'Loại lịch', 'is_natural_no_zero');

            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');

            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'start_time', 'end_time', 'content', 'publish', 'category_id'));
                $this->Mcalendar->ModifyRow($data['post_data'], $id);

                $this->mycommonlib->redir_alert('Thay đổi thông tin thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/calendar/');
            }
        }else{
            $data['post_data'] = $raw_data;
        }


        $data['auth']               = $this->auth;
        $data['tpl'] = 'backend/calendar/edit';
        $this->load->view('backend/layout/home', $data);
    }
}