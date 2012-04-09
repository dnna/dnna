<?php
class Aueb_Model_Entry {
    protected $_coursename;
    
    protected $_room;
    
    protected $_prof;
    
    protected $_comments;

    protected $_start;

    protected $_end;

    public function get_coursename() {
        return $this->_coursename;
    }

    public function set_coursename($_coursename) {
        $this->_coursename = $_coursename;
    }

    public function get_room() {
        return $this->_room;
    }

    public function set_room($_room) {
        $this->_room = $_room;
    }

    public function get_prof() {
        return $this->_prof;
    }

    public function set_prof($_prof) {
        $this->_prof = $_prof;
    }

    public function get_comments() {
        return $this->_comments;
    }

    public function set_comments($_comments) {
        $this->_comments = $_comments;
    }

    public function get_start() {
        return $this->_start;
    }

    public function set_start($_start) {
        $this->_start = $_start;
    }

    public function get_end() {
        return $this->_end;
    }

    public function set_end($_end) {
        $this->_end = $_end;
    }

    public function __toString() {
        if(!isset($this->_comments) || $this->_comments == '') {
            return $this->get_coursename();
        } else {
            //return $this->get_coursename().' - '.current(explode(' ', trim($this->get_comments())));
            return $this->get_coursename().' - '.$this->get_comments();
        }
    }
}
?>