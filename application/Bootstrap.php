<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initAutoloader() {
        $options = $this->getOptions();
        $loader = new Zend_Application_Module_Autoloader(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => $options['appnamespace'],
                ));
        include_once(APPLICATION_PATH . '/plugins/EZend_Date.php'); // EZend_Date
    }

    protected function _initCache() {
        $frontendOptions = array(
            'lifetime' => 7200, // cache lifetime of 2 hours
            'automatic_serialization' => true
        );

        // Μετατρέπουμε το directory separator σε Unix based (παίζει και στα Windows έτσι)
        if (DIRECTORY_SEPARATOR !== '/') {
            $cachedir = str_replace(DIRECTORY_SEPARATOR, '/', realpath(sys_get_temp_dir()));
        } else {
            $cachedir = realpath(sys_get_temp_dir());
        }
        Zend_Registry::set('cachePath', $cachedir);
        $backendOptions = array(
            'cache_dir' => $cachedir
        );

        $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        Zend_Registry::set('cache', $cache);
    }

    protected function _initTimezone() {
        $options = $this->getOptions();
        date_default_timezone_set($options['phpSettings']['date']['timezone']);
    }

    protected function _initDoctrine() {
        if ($this->hasPluginResource('doctrine2')) {
            //doctrine autoloader
            include_once(APPLICATION_PATH . '/../library/Doctrine/Common/ClassLoader.php'); // Για να μη βγάζει error στο Γερμανικό server
            $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', APPLICATION_PATH . '/../library/');
            $classLoader->register();
            $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', APPLICATION_PATH . '/../library/');
            $classLoader->register();
            $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', APPLICATION_PATH . '/../library/');
            $classLoader->register();
            include_once('Doctrine/DBAL/Event/Listeners/MysqlSessionInit.php'); // Για να μη βγάζει error σε κάποια servers

            $doctrine2Resource = $this->getPluginResource('doctrine2');
            $doctrine2Resource->init();
            $em = $doctrine2Resource->getEntityManager();
            Zend_Registry::set("entityManager", $em);

            // Init extensions
            $classLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', APPLICATION_PATH . '/../library/');
            $classLoader->register();
        }
    }

    /**
     * http://code.google.com/p/dnna-zend-lib/
     */
    protected function _initDnnaLib() {
        $loader = new Zend_Application_Module_Autoloader(array(
                    'basePath' => APPLICATION_PATH.'/../library/Dnna',
                    'namespace' => 'Dnna',
                ));
        $loader->addResourceType('Controller', 'controllers/', 'Controller');
        if(class_exists('Doctrine\ORM\EntityManager')) {
            include_once(APPLICATION_PATH . '/../library/Dnna/plugins/PointType.php'); // Load the Point type
            //Assuming the entity manager is in Zend_Registry as entityManager
            $config = Zend_Registry::get('entityManager')->getConfiguration();
            $config->addCustomNumericFunction('DISTANCE', 'Dnna\Doctrine\Types\Distance');
            $config->addCustomNumericFunction('POINT_STR', 'Dnna\Doctrine\Types\PointStr');
            $config->addCustomNumericFunction('TIMEDIFFSEC', 'Dnna\Doctrine\Types\TimeDiffSec');
        }
        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH.'/../library/Dnna/controllers/helpers',
                                                      'Dnna_Action_Helper');
        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH.'/../library/Dnna/controllers/helpers/Rest',
                                                      'Dnna_Action_Helper_Rest');
        $this->bootstrap('view');
        $this->getResource('view')->addHelperPath(APPLICATION_PATH.'/../library/Dnna/views/helpers', 'Dnna_View_Helper');
    }

    protected function _initViewAndNavigation() {
        $navigationConfig = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml');
        $navigation = new Zend_Navigation($navigationConfig);
        Zend_Registry::set('navigation', $navigation);
        $this->getResource('view')->navigation(Zend_Registry::get('navigation'));
    }

    /*protected function _initDisableErrorHandler() {
        Zend_Controller_Front::getInstance()->setParam('noErrorHandler', true);
    }*/
}

?>