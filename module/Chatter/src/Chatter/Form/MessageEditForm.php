<?php
namespace Chatter\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;

class MessageEditForm extends Form
{
    public function __construct(ObjectManager $em)
    {
        parent::__construct('message-edit-form');
        
        $this->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($em, 'Chatter\Model\Message'))
             ->setInputFilter(new InputFilter());
        
        $fieldset = new MessageFieldset($em);
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
                'value' => 'Save',
                'id'    => 'submitbutton',
                'class' => 'btn btn-success',
            ),
        ));
        
        $this->setValidationGroup(array(
            'csrf',
            'message' => array(
                'id',
                'text',
            )
        ));
    }
}
