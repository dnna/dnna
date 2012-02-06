<?php
class Application_Form_Contact extends Dnna_Form_FormBase {
    public function init() {
        $this->addElement('text', 'name', array(
            'required' => true,
            'label' => 'yourname'
        ));
        $this->addElement('text', 'email', array(
            'required' => true,
            'label' => 'youremail'
        ));
        $this->addElement('textarea', 'message', array(
            'required' => true,
            'label' => 'yourmessage'
        ));
        $this->addElement('submit', 'email', array(
            'required' => false,
            'ignored' => true,
            'label' => 'youremail'
        ));
    }
}
?>