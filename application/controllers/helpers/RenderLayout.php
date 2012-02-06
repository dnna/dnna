<?php
/**
 * Παίρνει ένα doc αρχείο και αντικαθιστά κάποια strings μέσα σε αυτό. Στη
 * συγκεκριμένη εφαρμογή χρησιμοποιείται για την παραγωγή των αιτήσεων μέσα από
 * τις φόρμες.
 * @author Dimosthenis Nikoudis <dnna@dnna.gr>
 */
class Application_Action_Helper_RenderLayout extends Zend_Controller_Action_Helper_Abstract {
    public function direct(Zend_Controller_Action $controller, $phtmlfile = null) {
        $request = $controller->getRequest();
        if(!isset($phtmlfile)) {
            $phtmlfile = $request->getActionName();
        }
        $controller->getHelper('viewRenderer')->setNoRender(TRUE);
        $content = $controller->view->render($request->getControllerName().'/'.$phtmlfile.'.phtml');
        if($request->getParam('ajax', false) == false) {
            $controller->view->languages = Application_Plugin_SetLocalePlugin::getAvailableLocales();
            $controller->view->content = $content;
            echo $controller->view->render('partials/layout.phtml');
            return;
        } else {
            echo $content;
        }
    }
}
?>