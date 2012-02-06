<?php

/**
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_Plugin_SetLocalePlugin extends Zend_Controller_Plugin_Abstract {

    protected static $_lang = array(
        'en' => array('en'),
        'el' => array('el', 'gr')
    );

    protected function getSubdomains() {
        $url = 'http://' . $_SERVER['SERVER_NAME'];
        $parsedUrl = parse_url($url);
        $host = explode('.', $parsedUrl['host']);
        $subdomains = array_slice($host, 0, count($host) - 2);
        return $subdomains;
    }

    protected function getLang() {
        $subdomains = $this->getSubdomains();
        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $r = new Zend_Controller_Action_Helper_Redirector;
        if(isset($subdomains[count($subdomains) - 1])) {
            $lastsubdomain = $subdomains[count($subdomains) - 1];
        }
        $bgdf = new BrowserGetDefaultLanguage();
        $browserlanguage = $bgdf->getDefaultLanguage();
        if(strpos($browserlanguage, '-') !== false) {
            $browserlanguage = substr($browserlanguage, 0, strpos($bgdf->getDefaultLanguage(), '-'));
        }
        if (count($subdomains) >= 1 && (!isset($lastsubdomain) || !in_array($lastsubdomain, array_keys(self::$_lang)))) {
            $r->gotoUrl(preg_replace('/' . $lastsubdomain . '/i', $browserlanguage, $view->getCurrentUrl()))->redirectAndExist();
        } else if (count($subdomains) <= 0) {
            $url = parse_url($view->getCurrentUrl());
            $url['host'] = $browserlanguage . '.' . $url['host'];
            $r->gotoUrl(http_build_url($url))->redirectAndExist();
        }
        foreach (self::$_lang as $curLang => $curSubdomains) {
            if (in_array($lastsubdomain, $curSubdomains)) {
                return $curLang;
            }
        }
        throw new Exception('Language not found.');
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $lang = $this->getLang();
        if ($lang == 'en') {
            $locale = 'en_US';
            $linkedinurl = 'http://gr.linkedin.com/in/dimosthenisnikoudis';
        } else {
            $locale = 'el_GR';
            $linkedinurl = 'http://gr.linkedin.com/in/dimosthenisnikoudis/el';
        }
        Zend_Registry::set('LinkedInUrl', $linkedinurl);
        Zend_Registry::set('Zend_Locale', new Zend_Locale($locale));
        // set up translation adapter
        $tr = new Zend_Translate('array', APPLICATION_PATH . '/lang', 'en', array('scan' => Zend_Translate::LOCALE_DIRECTORY));
        // set default locale
        $tr->setLocale(Zend_Registry::get('Zend_Locale')->toString());
        Zend_Date::setOptions();
        Zend_Form::setDefaultTranslator($tr);
        Zend_Registry::set('Zend_Translate', $tr);
    }
    
    public static function getAvailableLocales() {
        $locales = array();
        $tr = Zend_Registry::get('Zend_Translate');
        foreach(self::$_lang as $curLang => $nothing) {
            $locales[$curLang] = $tr->_($curLang);
        }
        return $locales;
    }

}

class BrowserGetDefaultLanguage {
    #########################################################
    # Copyright © 2008 Darrin Yeager                        #
    # http://www.dyeager.org/                               #
    # Licensed under BSD license.                           #
    #   http://www.dyeager.org/downloads/license-bsd.php    #
    #########################################################

    public function getDefaultLanguage() {
        if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            return $this->parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        } else {
            return $this->parseDefaultLanguage(NULL);
        }
    }

    protected function parseDefaultLanguage($http_accept, $deflang = "en") {
        if (isset($http_accept) && strlen($http_accept) > 1) {
            # Split possible languages into array
            $x = explode(",", $http_accept);
            foreach ($x as $val) {
                #check for q-value and create associative array. No q-value means 1 by rule
                if (preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i", $val, $matches))
                    $lang[$matches[1]] = (float) $matches[2];
                else
                    $lang[$val] = 1.0;
            }

            #return default language (highest q-value)
            $qval = 0.0;
            foreach ($lang as $key => $value) {
                if ($value > $qval) {
                    $qval = (float) $value;
                    $deflang = $key;
                }
            }
        }
        return strtolower($deflang);
    }

}

?>