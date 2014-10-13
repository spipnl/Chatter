<?php
namespace Chatter\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class MessageFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $em)
    {
        parent::__construct('message');
        
        $this->setHydrator(new DoctrineHydrator($em, 'Chatter\Entity\Message'));
             //->setObject(new Chat());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'text',
            'options' => array(
                'label' => 'The text of the message goes here',
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
            'text' => array(
                'required' => true,
            ),
        );
    }
}
