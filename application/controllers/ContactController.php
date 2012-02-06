<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class ContactController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->pageTitle = 'headlinemain';
        $form = new Application_Form_Contact();
        if ($this->getRequest()->isPost()) {
            // Η φόρμα έχει σταλθεί. Ελέγχουμε αν ειναι έγκυρη.
            if ($form->isValid($this->getRequest()->getPost())) {
                // Η φόρμα ΕΙΝΑΙ έγκυρη. Αποθηκεύουμε στη βάση και στέλνουμε το χρήστη στη σελίδα επιβεβαίωσης.
                $this->_helper->emailContact($form->getValues());
                $this->_helper->renderLayout($this, 'sendconfirm');
                return;
            }
        }
        $this->view->form = $form;
        $this->_helper->renderLayout($this);
    }
}