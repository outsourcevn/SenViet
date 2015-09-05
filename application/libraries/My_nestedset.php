<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_nestedset{
    private $CI;
    public $data;
    public $left;
    public $right;
    public $level;
    public $checked;
    public $arr;
    public $n;
    public $count = 0;
    public $count_level = 0;
    
    public function __construct(){
        $this->CI = get_instance();
    }
    
    /**
	 * Sets the ORDER BY value
	 *
	 * @param	string
	 * @return	object
	 **/
    public function gen_tree($table = 'category')
    {
        $this->data = $this->CI->db->order_by('`level` ASC, `order` ASC, `id` ASC')->get($table)->result_array();
        
        $count = 0;

        $row = $this->CI->db->order_by('`level` ASC, `order` ASC, `id` ASC')->get($table)->result_array();
        
        foreach($row as $key => $val)
        {
            $this->arr[$val['id']][$val['parentid']] = 1;
            $this->arr[$val['parentid']][$val['id']] = 1;
        }
        
        if(count($this->arr))
        {
            $this->recursive(0, $table);
            //$this->dropdown();
        }
    }
    
    public function recursive($start = 0, $table = 'category')
    {
        $this->left[$start] = ++$this->count;
        $this->level[$start] = $this->count_level;
        $this->CI->db->update($table, array('lft'=>$this->left[$start]), array('id' => $start));
        
        foreach($this->arr as $key => $val)
        {
            if((isset($this->arr[$start][$key]) || isset($this->arr[$key][$start])) &&(!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key])))
            {
                $this->count_level++;
                $this->checked[$start][$key] = 1;
                $this->checked[$key][$start] = 1;
                $this->recursive($key, $table);
                $this->count_level--;
            }
        }
        $this->right[$start] = ++$this->count;
        $this->CI->db->update($table, array('rgt'=>$this->right[$start]), array('id' => $start));
        $this->CI->db->update($table, array('level'=>$this->level[$start]), array('id' => $start));
    }
    
    public function dropdown($table = 'category', $data = null){
		$temp = NULL;
        
        if(!count($data) && !is_array($data))
        {
            if(!$data = $this->data)
            {
                $this->gen_tree($table);
                $data = $this->data;
            }
        }
        
        foreach($data as $key => $val)
        {
            $temp_data[$val['id']] = $data[$key];
        }
        
        unset($data);
        $data = $temp_data;
        
        foreach($this->level as $key => $val)
        {
            if($key != 0)
            {
                $temp[$key] = str_repeat('|----- ', $val-1).$data[$key]['title'];
            }
            else
            {
                //$temp[0] = 'ROOT';
            }
        }
        
        //print_r($temp);
        
		return $temp;
	}
}