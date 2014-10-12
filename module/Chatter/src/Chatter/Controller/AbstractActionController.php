<?php
namespace Chatter\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\MvcEvent;

/**
 * Extended action controller for easy access to the Entity Manager
 */
abstract class AbstractActionController extends \Zend\Mvc\Controller\AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * Get the Entity Manager
     * 
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em && $this->getServiceLocator()->has('doctrine.entitymanager.orm_default')) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
}
