<?php
namespace Chatter\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class CreateBlogPostForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('create-blog-post-form');

        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Chatter\Model\BlogPost'));

        // Add the user fieldset, and set it as the base fieldset
        $blogPostFieldset = new BlogPostFieldset($objectManager);
        $blogPostFieldset->setUseAsBaseFieldset(true);
        $this->add($blogPostFieldset);

        // … add CSRF and submit elements …
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        // Optionally set your validation group here
    }
}