<?php
class Resizeimage extends CI_Controller{
    public function __construct(){
        parent :: __construct();
    }
    
    public function index(){
        //header('Content-type: image/jpeg');
        
        $link = $this->input->get('link');
        $max_height = $this->input->get('max_height');
        $max_width = $this->input->get('max_width');
        
        
        //$myimage = resizeImage('filename', 'newwidthmax', 'newheightmax');
        //$myimage = $this->resizeImage($link, $max_width, $max_height);
        //echo  $myimage;
        
        
        $image = file_get_contents('public/tmp/'.$this->Image($link, $max_width, $max_height).'.jpg');
        
        $this->load->view('frontend/images', array('images' => $image));
        
        unlink('public/tmp/'.$this->Image($link, $max_width, $max_height).'.jpg');
    }
    
    private function resizeImage($filename, $newwidth, $newheight){
        list($width, $height) = getimagesize($filename);
        
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return imagejpeg($thumb);
    }
    
    private function Image($link, $max_width, $max_height){
        $this->load->library('ImageManipulator');
        
        $im = new ImageManipulator($link);
        $centreX = round($im->getWidth() / 2);
        $centreY = round($im->getHeight() / 2);
        
        $x1 = $centreX - $max_width/2;
        $y1 = $centreY - $max_height/2;
        
        $x2 = $centreX + $max_width/2;
        $y2 = $centreY + $max_height/2;
        
        $im->crop($x1, $y1, $x2, $y2); // takes care of out of boundary conditions automatically
        $str_image = md5(time());
        $im->save('public/tmp/'.$str_image.'.jpg');
        return $str_image;
    }
}