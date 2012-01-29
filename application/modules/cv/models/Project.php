<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 * @Entity @Table(name="fullitems")
 */
class Cv_Model_Project extends Cv_Model_Item {
    protected $_url;

    public function get_url() {
        return $this->_url;
    }

    public function set_url($_url) {
        $this->_url = $_url;
    }
}
?>