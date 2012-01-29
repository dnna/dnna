<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 * @Entity @Table(name="items")
 */
class Cv_Model_Item extends Cv_Model_ItemBase {
    /**
     * @Column (name="title", type="string")
     */
    protected $_title;
    /**
     * @Column (name="title", type="date")
     */
    protected $_startdate;
    /**
     * @Column (name="title", type="date")
     */
    protected $_enddate;
    /**
     * @Column (name="title", type="string")
     */
    protected $_location;

    public function get_title() {
        return $this->_title;
    }

    public function set_title($_title) {
        $this->_title = trim($_title);
    }

    public function get_startdate() {
        return $this->_startdate;
    }

    public function set_startdate($_startdate) {
        $date = DateTime::createFromFormat('Y-m-d', $_startdate);
        if($date != false) {
            $this->_startdate = new EZend_Date($date->format('U'));
        }
    }

    public function get_enddate() {
        if(isset($this->_enddate) && $this->_enddate != false) {
            return $this->_enddate;
        } else {
            return Zend_Registry::get('Zend_Translate')->_('present');
        }
    }

    public function set_enddate($_enddate) {
        $date = DateTime::createFromFormat('Y-m-d', $_enddate);
        if($date != false) {
            $this->_enddate = new EZend_Date($date->format('U'));
        }
    }

    public function get_location() {
        return $this->_location;
    }

    public function set_location($_location) {
        $this->_location = trim($_location);
    }

    public function __toString() {
        return $this->get_title();
    }
}
?>