<?php
class Ausgehen_Bootstrap extends Zend_Application_Module_Bootstrap 
{
    protected function _initHelpers() {
        $front = Zend_Controller_Front::getInstance();
        $moduledir = $front->getModuleDirectory(strtolower($this->getModuleName()));
        Zend_Controller_Action_HelperBroker::addPath($moduledir.'/controllers/helpers', 'Ausgehen_Action_Helper');
        //$front->registerPlugin(new Aitiseis_Plugin_PopulateNavigationPlugin($this->getModuleName()));
    }
}
?>