<?php
namespace Chatter\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $em)
    {
        parent::__construct('user');
        
        $this->setHydrator(new DoctrineHydrator($em, 'Chatter\Entity\User'));
             //->setObject(new Chat());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name',
            'options' => array(
                'label' => 'The name of the user goes here',
            ),
            'attributes' => array(
                'required' => 'required',
                'class'    => 'form-control',
            )
        ));
    }
    
    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => true,
            ),
            'name' => array(
                'required' => true,
            ),
        );
    }
}
