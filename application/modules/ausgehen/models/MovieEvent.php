<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Ausgehen_Model_MovieEvent extends Ausgehen_Model_Event {
    protected $_movietitle;

    protected $_cinemaname;

    protected $_cinemalink;

    protected $_cinemaaddress;
    
    protected $_cinemaroom; // Αίθουσα
    
    protected $_length;
    
    protected $_startdates;

    public function get_movietitle() {
        return $this->_movietitle;
    }

    public function set_movietitle($_movietitle) {
        $this->_movietitle = $_movietitle;
    }

    public function get_cinemaname() {
        return $this->_cinemaname;
    }

    public function set_cinemaname($_cinemaname) {
        $this->_cinemaname = $_cinemaname;
    }

    public function get_cinemalink() {
        return $this->_cinemalink;
    }

    public function set_cinemalink($_cinemalink) {
        $this->_cinemalink = $_cinemalink;
    }

    public function get_cinemaaddress() {
        return $this->_cinemaaddress;
    }

    public function set_cinemaaddress($_cinemaaddress) {
        $this->_cinemaaddress = $_cinemaaddress;
    }

    public function get_cinemaroom() {
        return $this->_cinemaroom;
    }

    public function set_cinemaroom($_cinemaroom) {
        $this->_cinemaroom = $_cinemaroom;
    }

    public function get_length() {
        return $this->_length;
    }

    public function set_length($_length) {
        $this->_length = $_length;
    }

    public function get_startdates() {
        return $this->_startdates;
    }

    public function set_startdates($_startdates) {
        $this->_startdates = $_startdates;
    }
}
?>