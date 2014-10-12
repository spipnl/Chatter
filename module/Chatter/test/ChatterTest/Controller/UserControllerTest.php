<?php
/**
 * UserControllerTest
 * 
 * Jip Spinnewijn
 */
namespace ChatterTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class UserControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include '/config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/user');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Chatter');
        $this->assertControllerName('Chatter\Controller\User');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('user');
    }
}
