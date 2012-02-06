<?php
Zend_Controller_Action_HelperBroker::getStaticHelper('EmailBase');
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_Action_Helper_EmailContact extends Dnna_Action_Helper_EmailBase {
    public function direct($formvalues) {
        $mail = new Zend_Mail('UTF-8');
        $mail->setFrom($this->_emailfromaddress, $this->_emailfromname);
        $mail->addTo('dnna@dnna.gr', 'Dimosthenis Nikoudis');
        $mail->setSubject('Message from '.$formvalues['name'].' ('.$formvalues['email'].') via dnna.gr contact form');
        $mail->setBodyText($formvalues['message']);
        // Μερικά extra headers για να μην πηγαίνει στο spam
        $mail->setReplyTo($this->_emailfromaddress, $this->_emailfromname);
        // Αποστολή
        $mail->send($this->_tr);
    }
}
?>