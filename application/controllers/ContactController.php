<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class ContactController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->pageTitle = 'headlinemain';
        $this->_helper->renderLayout($this);
    }
}