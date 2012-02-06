<?php
class Application_Form_Contact extends Dnna_Form_FormBase {
    public function init() {
        $this->addElement('text', 'name', array(
            'required' => true,
            'label' => 'yourname'
        ));
        $this->addElement('text', 'email', array(
            'required' => true,
            'label' => 'youremail',
            'validators' => array(
                array('validator' => 'EmailAddress'),
            )
        ));
        $this->addElement('textarea', 'message', array(
            'required' => true,
            'label' => 'yourmessage',
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, $this->_textareaMaxLength)),
            ),
            'rows' => $this->_textareaRows,
            'cols' => $this->_textareaCols,
        ));
        $this->addElement('submit', 'send', array(
            'required' => false,
            'ignore' => true,
            'label' => 'send'
        ));
    }
}
?>