<?php
namespace Chatter\Form;

use Zend\Form\Form;

class UserAddForm extends Form
{
    public function __construct()
    {
        parent::__construct('user-add-form');
        
        $this->setAttribute('method', 'post');

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
                'name',
            )
        ));
    }
}
