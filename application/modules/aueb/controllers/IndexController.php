<?php

class Aueb_IndexController extends Zend_Controller_Action {
    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);

        // create a new cURL resource
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, 'http://schedule.aueb.gr/index.php');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($this->_request->isPost()) {
            $post = $this->_request->getPost();
            curl_setopt($ch,CURLOPT_POST,count($post));
            curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($post));
        }

        // grab URL and pass it to the browser
        $result = curl_exec($ch);

        include_once(APPLICATION_PATH . '/plugins/SimpleHTML.php');
        $html = str_get_html($result);
        $head = $html->getElementsByTagName('head');
        $head->innertext = '<base href="http://schedule.aueb.gr/">' . $head->innertext;
        $form = $html->getElementByTagName('form');
        $form->action = '';
        
        // If .wood array exists we have a schedule to parse
        $schedule = $html->find('.schedule', 0);
        if(isset($schedule)) {
            $entries = $this->_helper->parseSchedule($schedule);
            echo $this->_helper->createIcal($this, $entries);
        } else {
            echo $html;
        }

        // close cURL resource, and free up system resources
        curl_close($ch);
    }

}