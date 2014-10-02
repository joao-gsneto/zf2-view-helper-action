<?php

namespace Barato\View\Helper; //change to add your custom namespace

use Zend\View\Helper\AbstractHelper,
    Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Call a Controller action
 * Don't forget to add on module config:
 * 
 *  'view_helpers' => array(
 *       'invokables' => array(
 *           'action' => 'Barato\View\Helper\Action',
 *       ),
 *   ),
 * 
 * @package Barato_View
 * @subpackage Helper
 * @copyright Copyright (c) 2014 - Joao Neto <eu@joaoneto.blog.br>
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */
class Action extends AbstractHelper implements ServiceLocatorAwareInterface {

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AbstractHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function __invoke($controllerName, $actionName, $params = array()) {

        $controllerLoader = $this->serviceLocator->getServiceLocator()->get('ControllerLoader');

        //checks if ZfTwig exists, otherwise use default view renderer
        //to add custom viewRenderer, change this
        try {
            $renderer = $this->serviceLocator->getServiceLocator()->get('ZfcTwig\View\TwigRenderer');
        } catch (\Exception $ex) {
            $renderer = $this->serviceLocator->getServiceLocator()->get('ViewRenderer');
        }
        $controller = $controllerLoader->get($controllerName);

        $params['action'] = $actionName;
        $viewModel = $controller->forward()->dispatch($controllerName, $params);

        return $renderer->render($viewModel);
    }

}
