<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();

        $em = $eventManager->getSharedManager();
        // To validate new field
        $em->attach('ZfcUser\Form\Register','init', function($e) {
                $filter = $e->getTarget();
                $element = $filter->add(
                    array(
                        'name'       => 'bio',
                        'required'   => false,
                        'allowEmpty' => true,
                        'filters'    => array(array('name' => 'StringTrim')),
                        'type'       => 'Zend\Form\Element\Textarea',
                        'attributes' => array(
                            'cols' => 40,
                            'rows' => 10
                        ),
                        'options'    => array(
                            'label'  => 'Bio'
                        )
                    )
                );

            });

        // Store the field
        $zfcServiceEvents->attach('register', function($e) {
                $form = $e->getParam('form');
                $user = $e->getParam('user');

                $user->setUsername( $form->get('username')->getValue() );
                $user->setBio( $form->get('bio')->getValue() );
            });


    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
