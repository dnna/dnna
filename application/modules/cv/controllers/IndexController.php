<?php

class Cv_IndexController extends Zend_Controller_Action {
    /**
     * indexAction
     *
     * When the client is authorized, this will retrieve the
     * authorized users' profile and pass it to the view for
     * dislay. The boolean parameter indicates that custom
     * fields are also requested.
     *
     * @return void
     */
    public function indexAction() {
        $this->view->profile = $this->_helper->parseProfile(Zend_Registry::get('LinkedInUrl'));
    }

}