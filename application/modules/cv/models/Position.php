<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 * @Entity @Table(name="fullitems")
 */
class Cv_Model_Position extends Cv_Model_Item {
    protected $_company;

    public function get_company() {
        return $this->_company;
    }

    public function set_company($_company) {
        $this->_company = $_company;
    }
}
?>