<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 * @Entity @Table(name="fullitems")
 */
class Cv_Model_Education extends Cv_Model_Item {
    protected $_degree;

    protected $_major;

    protected $_grade;
    
    protected $_characterization;

    public function get_degree() {
        return $this->_degree;
    }

    public function set_degree($_degree) {
        $this->_degree = trim($_degree);
    }

    public function get_major() {
        return $this->_major;
    }

    public function set_major($_major) {
        $this->_major = trim($_major);
    }

    public function get_grade() {
        return $this->_grade;
    }

    public function set_grade($_grade) {
        $this->_grade = trim($_grade);
    }

    public function get_characterization() {
        return $this->_characterization;
    }

    public function set_characterization($_characterization) {
        $this->_characterization = trim($_characterization);
    }

    public function set_content($_content) {
        $pieces = explode("&#x25a0;", $_content);
        $regex = '#\((([^()]+|(?R))*)\)#';
        preg_match_all($regex, $_content, $matches);
        $grade = explode(':', $pieces[1]);
        $grade = trim(str_replace('('.$matches[1][0].')', '', $grade[1]));
        $this->set_characterization($matches[1][0]);
        $this->set_grade($grade);
        array_shift($pieces);
        array_shift($pieces);
        $_content = trim("&#x25a0;".implode("&#x25a0;", $pieces));
        parent::set_content($_content);
    }
}
?>