<?php
namespace Chatter\Controller;

use Chatter\Form\UserAddForm;
use Chatter\Form\UserEditForm;
use Chatter\Entity\User;
use Chatter\Service\UserService;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        /** @var UserService $userService */
        $userService = $this->getServiceLocator()->get('userService');

        $users = $userService->getAllUsers();

        return array(
            'users' => $users,
        );
    }
    
    public function addAction()
    {
        $user = new User();
        $formManager = $this->getServiceLocator()->get('FormElementManager');
        /** @var UserAddForm $form */
        $form = $formManager->get('userAddForm');
        $form->bind($user);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush($user);
                $this->redirect()->toRoute('user');
            }
        }
        
        return array(
            'form' => $form,
        );
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('user', array(
                'action' => 'add',
            ));
        }
        
        // Get the User with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            /** @var UserService $userService */
            $userService = $this->getServiceLocator()->get('userService');

            $user = $userService->getUserById($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('user', array(
                'action' => 'index',
            ));
        }

        $formManager = $this->getServiceLocator()->get('FormElementManager');
        /** @var UserEditForm $form */
        $form = $formManager->get('userEditForm');
        $form->bind($user);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush($user);
                $this->redirect()->toRoute('user');
            }
        }

        return array(
            'user' => $user,
            'form'  => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        // Get the User with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $user = $this->getEntityManager()->find('Chatter\Entity\User', $id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('user', array(
                'action' => 'index',
            ));
        }

        $user->delete($this->getEntityManager());

        return $this->redirect()->toRoute('user', array(
            'action' => 'index',
        ));
    }
}