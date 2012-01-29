<?php
/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_Plugin_SetLocalePlugin extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $lang = $request->getParam('lang', 'el');
        if($lang == 'en') {
            $locale = 'en_US';
            $linkedinurl = 'http://gr.linkedin.com/in/dimosthenisnikoudis';
        } else {
            $locale = 'el_GR';
            $linkedinurl = 'http://gr.linkedin.com/in/dimosthenisnikoudis/el';
        }
        Zend_Registry::set('LinkedInUrl', $linkedinurl);
        Zend_Registry::set('Zend_Locale', new Zend_Locale($locale));
        // set up translation adapter
        $tr = new Zend_Translate('array', APPLICATION_PATH.'/lang', 'en', array('scan' => Zend_Translate::LOCALE_DIRECTORY));
        // set default locale
        $tr->setLocale(Zend_Registry::get('Zend_Locale')->toString());
        Zend_Date::setOptions();
        Zend_Form::setDefaultTranslator($tr);
        Zend_Registry::set('Zend_Translate', $tr);
    }
}
?>