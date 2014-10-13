<?php
namespace Chatter\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;

class ChatEditForm extends Form
{
    public function __construct(ObjectManager $em)
    {
        parent::__construct('chat-edit-form');
        
        $this->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($em, 'Chatter\Entity\Chat'))
             ->setInputFilter(new InputFilter());
        
        $fieldset = new ChatFieldset($em);
        //$fieldset->setName('chat');
        //$fieldset->remove('id');
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
        
        $this->setValidationGroup(array(
            'csrf',
            'chat' => array(
                'id',
                'title',
            )
        ));
    }
}
