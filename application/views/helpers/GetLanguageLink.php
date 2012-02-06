<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_View_Helper_GetLanguageLink extends Zend_View_Helper_Abstract
{
    public $view;
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

    public function getLanguageLink($newlanguage = 'en') {
        $url = parse_url($this->view->getCurrentUrl());
        $url['host'] = str_replace(Zend_Registry::get('Zend_Locale')->getLanguage(), $newlanguage, $url['host']);
        return http_build_url($url);
    }
}
?>