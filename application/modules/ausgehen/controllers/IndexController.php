<?php

class Ausgehen_IndexController extends Zend_Controller_Action {
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
        $this->view->pageTitle = 'Ausgehen';
        $this->view->events = $this->_helper->parseCinemas();
    }

}