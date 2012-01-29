<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_View_Helper_GetMonth extends Zend_View_Helper_Abstract
{
    public static $months;

    public $view;
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

    public function getMonth($number) {
        if(!isset(self::$months)) {
            self::$months = Zend_Locale::getTranslationList('months', Zend_Registry::get('Zend_Locale')->toString());
            if(!is_numeric(self::$months['stand-alone']['wide'][$number])) {
                self::$months = self::$months['stand-alone']['wide'];
            } else {
                self::$months = self::$months['format']['wide'];
            }
            return self::$months[$number];
        }
    }
}
?>