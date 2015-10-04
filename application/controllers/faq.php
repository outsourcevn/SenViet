<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller
{

    var $configs = null;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index()
    {

        //Configs
        $data['configuration'] = $this->configs;
        $data['configuration']->meta_title = 'Câu hỏi thường gặp - ' . $data['configuration']->meta_title;
        $data['active_nav'] = 'nav_faq';

        $data['faq_data'] = $this->db->where('publish', 1)->get('faq')->result_object();

        //View
        $data['tpl'] = 'frontend/faq/faq';
        if ($this->configs->is_active) {
            $this->load->view('frontend/layout/1-column', $data);
        } else {
            $this->load->view('frontend/home/maintain', $data);
        }
    }

    public function downloadFile($id)
    {
        $query = $this->db->where('publish', 1)->where('id', $id)->get('faq_sheet');
        if ($query->num_rows() == 1) {
            $file = $query->row_object();

            $workPath = getcwd();
            $file->link = urldecode($file->link);

            if (file_exists($workPath . $file->link)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($workPath . $file->link) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($workPath . $file->link));
                readfile($workPath . $file->link);
                exit;

            } else {
                echo "File bạn yêu cầu không tồn tại.";
            }

        } else {
            redirect('/');
        }
    }

    public function sheet()
    {
        $id = $this->input->get('id');
        if (is_numeric($id)) {
            $this->downloadFile($id);
        } else {
            //Configs
            $data['configuration'] = $this->configs;
            $data['configuration']->meta_title = 'Quy trình - Biểu Mẫu - ' . $data['configuration']->meta_title;
            $data['active_nav'] = 'nav_faq';

            $data['sheet_data'] = $this->db->where('publish', 1)->order_by('created_date', 'DESC')->get('faq_sheet')->result_object();


            //View
            $data['tpl'] = 'frontend/faq/sheet';
            if ($this->configs->is_active) {
                $this->load->view('frontend/layout/1-column', $data);
            } else {
                $this->load->view('frontend/home/maintain', $data);
            }
        }
    }
}