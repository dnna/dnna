<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Cv_Model_ItemBase extends Dnna_Model_Object {
    /**
     * @Id
     * @Column (name="projectid", type="integer")
     * @GeneratedValue
     */
    protected $_id;
    /**
     * @Column (name="title", type="string")
     */
    protected $_content;

    public function get_content() {
        return $this->_content;
    }

    public function set_content($_content) {
        $pieces = explode("&#x25a0;", $_content);

        $ul = false;
        $i = 1;
        while(isset($pieces[$i])) {
            $ul = true;
            $pieces[$i] = '<li>'.$pieces[$i].'</li>';
            $i++;
        }
        $_content = implode('', $pieces);
        if($ul == true) {
            $_content = '<ul>'.$_content.'</ul>';
        }
        $this->_content = $_content;
    }

    public function __toString() {
        return $this->get_content();
    }
}
?>