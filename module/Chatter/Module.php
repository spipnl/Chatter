<?php
namespace Chatter;

use Chatter\Form\UserAddForm;
use Chatter\Form\UserEditForm;
use Chatter\Form\UserFieldset;
use Chatter\Repository\UserRepository;
use Chatter\Service\UserService;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\InputFilter\InputFilter;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ServiceManager\AbstractPluginManager;

class Module implements FormElementProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'userService' => function ($sl) {
                    /** @var EntityManager $entityManager */
                    $entityManager = $sl->get('doctrine.entitymanager.orm_default');
                    $userService = new UserService();
                    $userService->setEntityManager($entityManager);

                    $userRepository = $entityManager->getRepository('Chatter\Entity\User');
                    $userService->setRepository($userRepository);
                    return $userService;
                },
            ),
        );
    }

    public function getFormElementConfig()
    {
        return array(
            'factories' => array(
                'userAddForm' => function(AbstractPluginManager $sm) {
                    $locator = $sm->getServiceLocator();
                    /** @var EntityManager $entityManager */
                    $entityManager = $locator->get('doctrine.entitymanager.orm_default');

                    $userAddForm = new UserAddForm();
                    $userAddForm->setHydrator(new DoctrineObject($entityManager));
                    $userAddForm->setInputFilter(new InputFilter());

                    $userFieldset = new UserFieldset();
                    $userFieldset->setHydrator(new DoctrineObject($entityManager));

                    $userFieldset->setUseAsBaseFieldset(true);
                    $userAddForm->add($userFieldset);

                    return $userAddForm;
                },
                'userEditForm' => function(AbstractPluginManager $sm) {
                    $locator = $sm->getServiceLocator();
                    /** @var EntityManager $entityManager */
                    $entityManager = $locator->get('doctrine.entitymanager.orm_default');

                    $userEditForm = new UserEditForm();
                    $userEditForm->setHydrator(new DoctrineObject($entityManager));
                    $userEditForm->setInputFilter(new InputFilter());

                    $userFieldset = new UserFieldset();
                    $userFieldset->setHydrator(new DoctrineObject($entityManager));

                    $userFieldset->setUseAsBaseFieldset(true);
                    $userEditForm->add($userFieldset);

                    return $userEditForm;
                },
            ),
        );
    }
}