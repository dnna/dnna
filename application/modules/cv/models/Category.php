<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 * @Entity @Table(name="categories")
 */
class Cv_Model_Category extends Dnna_Model_Object {
    /**
     * @Id
     * @Column (name="id", type="integer")
     * @GeneratedValue
     */
    protected $_id;
    /**
     * @Column (name="name", type="string")
     */
    protected $_name;
    /**
     * @OneToMany (targetEntity="Cv_Model_ItemBase", mappedBy="_category")
     * @FormFieldLabel Items
     * @FormFieldType Recursive
     * @var Cv_Model_ItemBase
     */
    protected $_items;

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
    }

    public function get_items() {
        return $this->_items;
    }

    public function set_items($_items) {
        $this->_items = $_items;
    }

    public function __toString() {
        return $this->get_name();
    }
}
?>