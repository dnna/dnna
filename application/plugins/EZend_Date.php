<?php
class EZend_Date extends Zend_Date {
    public static $format;
    public static $timeformat;

    public function __toString() {
        if (self::$format == null) {
            self::$format = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOptions();
            self::$format = self::$format['date']['format'];
        }
        return (string) parent::toString(self::$format);
    }

    public function __toStringTime() {
        if (self::$timeformat == null) {
            self::$timeformat = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOptions();
            self::$timeformat = self::$timeformat['date']['timeformat'];
        }
        return (string) parent::toString(self::$timeformat);
    }

}
?>