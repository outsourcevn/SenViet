<?php
Class Model_contact extends CI_Model{
    const DB_TABLE = 'contacts';

    protected $id = null;
    var $full_name;
    var $tel;
    var $email;
    var $title;
    var $content;
    var $to = 0;
    var $seen = 0;
    var $created_date;
    var $updated_date;

    /**
     * Populate all variable to object
     * @param $arr
     * @return $this
     */
    function populate($arr){
        foreach($arr as $key => $val){
            if(property_exists(get_class($this), $key))
                $this->{$key} = $val;
        }
        return $this;
    }

    public function save() {
        try {
            if ($this->id !== null) {
                $this->updated_date = date('Y-m-d');

                $this->db->update(self::DB_TABLE, $this);
            } else {
                $this->created_date = date('Y-m-d');
                $this->updated_date = date('Y-m-d');
                $this->db->insert(self::DB_TABLE, $this);
            }
        } catch (Exception $e) {
            throw $e;
        }

        return $this;
    }
}