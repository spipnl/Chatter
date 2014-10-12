<?php
namespace Chatter\Controller;

use Chatter\Form\MessageAddForm;
use Chatter\Form\MessageEditForm;
use Chatter\Model\Message;

class MessageController extends AbstractActionController
{
    public function indexAction()
    {
        $messages = $this->getEntityManager()->createQueryBuilder()
                           ->select('m')
                           ->from('Chatter\Model\Message', 'm')
                           ->getQuery()
                           ->getResult();
        
        return array(
            'messages' => $messages,
        );
    }
    
    public function addAction()
    {
        $users = $this->getEntityManager()->createQueryBuilder()
                           ->select('u')
                           ->from('Chatter\Model\User', 'u')
                           ->getQuery()
                           ->getResult();
        
        $message = new Message();
        $message->setDateCreated(new \DateTime());
        $form = new MessageAddForm($this->getEntityManager());
        
        $form->bind($message);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($message);
                $this->getEntityManager()->flush($message);
                $this->redirect()->toRoute('message');
            }
        }
        
        return array(
            'form'  => $form,
            'users' => $users,
        );
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('message', array(
                'action' => 'add',
            ));
        }
        
        // Get the Message with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $message = $this->getEntityManager()->find('Chatter\Model\Message', $id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('message', array(
                'action' => 'index',
            ));
        }
        
        //Test
        $user = $this->getEntityManager()->find('Chatter\Model\User', 1);
        $message->setUser($user);
        
        $form = new MessageEditForm($this->getEntityManager());
        $form->bind($message);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($message);
                $this->getEntityManager()->flush($message);
                $this->redirect()->toRoute('message');
            }
        }
        
        return array(
            'message' => $message,
            'form'  => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        // Get the Message with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $message = $this->getEntityManager()->find('Chatter\Model\Message', $id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('message', array(
                'action' => 'index',
            ));
        }
        
        $message->delete($this->getEntityManager());
        
        return $this->redirect()->toRoute('message', array(
            'action' => 'index',
        ));
    }
}