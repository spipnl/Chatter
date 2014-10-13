<?php
namespace Chatter\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;

class UserEditForm extends Form
{
    public function __construct(ObjectManager $em)
    {
        parent::__construct('user-edit-form');
        
        $this->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($em, 'Chatter\Entity\User'))
             ->setInputFilter(new InputFilter());
        
        $fieldset = new UserFieldset($em);
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
            'user' => array(
                'id',
                'name',
            )
        ));
    }
}
