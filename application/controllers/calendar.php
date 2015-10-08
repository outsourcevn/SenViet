<?php
class Calendar extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function events(){
        //Configs
        $data['configuration'] = $this->configs;
        $data['configuration']->meta_title = 'Lịch sự kiện NPP'.' - '.$data['configuration']->meta_title;
        $data['active_nav'] = 'nav_npp';

        $data['breadcrumb'] = array(
            array(
                'title' => 'Thông tin NPP',
                'href'  => '/thong-tin-npp/'
            ),
            array(
                'title' => 'Lịch sự kiện NPP',
                'href'  => '/thong-tin-npp/lich-su-kien-npp'
            ),
        );



        //View
        $data['tpl']                = 'frontend/calendar/calendar';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }

    public function working(){
        //Configs
        $data['configuration'] = $this->configs;
        $data['configuration']->meta_title = 'Lịch làm việc'.' - '.$data['configuration']->meta_title;
        $data['active_nav'] = 'nav_training';

        $data['breadcrumb'] = array(
            array(
                'title' => 'Đào tạo',
                'href'  => '/dao-tao/'
            ),
            array(
                'title' => 'Lịch làm việc',
                'href'  => '/dao-tao/lich-lam-viec'
            ),
        );



        //View
        $data['tpl']                = 'frontend/calendar/working_calendar';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }

    public function working_schedule(){
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        if($start != ''){
            $param['start_time >='] = ($start.' 00:00:00');
        }
        if($end != ''){
            $param['end_time <='] = ($end.' 23:59:59');
        }

        if(is_array($param))
            $data = $this->db->where('publish', 1)->where('category_id', 1)->where($param)->get('calendar')->result_array();
        else
            $data = $this->db->where('publish', 1)->where('category_id', 1)->get('calendar')->result_array();

        $return = null;

        foreach($data as $_item){
            $temp_array['title'] = $_item['title'];
            $temp_array['start'] = $_item['start_time'];

            if($_item['end_time'] != '')
                $temp_array['end'] = $_item['end_time'];
            $temp_array['url'] = base_url().'calendar/detail/'.$_item['id'];

            $return[] = $temp_array;
        }

        echo json_encode($return);
    }

    public function event_schedule(){
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        if($start != ''){
            $param['start_time >='] = ($start.' 00:00:00');
        }
        if($end != ''){
            $param['end_time <='] = ($end.' 23:59:59');
        }

        if(is_array($param))
            $data = $this->db->where('publish', 1)->where('category_id', 2)->where($param)->get('calendar')->result_array();
        else
            $data = $this->db->where('publish', 1)->where('category_id', 2)->get('calendar')->result_array();

        $return = null;

        foreach($data as $_item){
            $temp_array['title'] = $_item['title'];
            $temp_array['start'] = $_item['start_time'];

            if($_item['end_time'] != '')
                $temp_array['end'] = $_item['end_time'];
            $temp_array['url'] = base_url().'calendar/detail/'.$_item['id'];

            $return[] = $temp_array;
        }

        echo json_encode($return);
    }

    public function detail($id){
        if(!is_numeric($id)){
            redirect('/');
        }

        $query = $this->db->where('publish', 1)->where('id', $id)->get('calendar');

        if($query->num_rows() == 1){
            $data['detail'] = $query->row_object();

            //Configs
            $data['configuration'] = $this->configs;
            $data['configuration']->meta_title = $data['detail']->title.' - '.$data['configuration']->meta_title;

            //View
            if($data['detail']->category_id == 1){
                $data['breadcrumb'] = array(
                    array(
                        'title' => 'Đào Tạo',
                        'href'  => '/dao-tao/'
                    ),
                    array(
                        'title' => 'Lịch làm việc',
                        'href'  => '/dao-tao/lich-lam-viec/'
                    ),
                    array(
                        'title' => $data['detail']->title,
                        'href'  => current_url()
                    ),
                );
                
                $data['active_nav'] = 'nav_training';
                
                $data['tpl']                = 'frontend/calendar/working_detail';
            }
            else
            {
                $data['breadcrumb'] = array(
                    array(
                        'title' => 'Đào Tạo',
                        'href'  => '/dao-tao/'
                    ),
                    array(
                        'title' => 'Lịch làm việc',
                        'href'  => '/dao-tao/lich-lam-viec/'
                    ),
                    array(
                        'title' => $data['detail']->title,
                        'href'  => current_url()
                    ),
                );
                
                $data['active_nav'] = 'nav_npp';
                $data['tpl']                = 'frontend/calendar/event_detail';
            }
                
            if($this->configs->is_active){
                $this->load->view('frontend/layout/1-column', $data);
            }else{
                $this->load->view('frontend/home/maintain', $data);
            }

        } else {
            redirect('/');
        }
    }
}