<?php
namespace Chatter\Controller;

use Chatter\Form\ChatAddForm;
use Chatter\Form\ChatEditForm;
use Chatter\Entity\Chat;

class ChatController extends AbstractActionController
{
    public function indexAction()
    {
        $chats = $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from('Chatter\Entity\Chat', 'c')
            ->getQuery()
            ->getResult();
        
        return array(
            'chats' => $chats,
        );
    }
    
    public function addAction()
    {
        $chat = new Chat();
        $form = new ChatAddForm($this->em);
        $form->bind($chat);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->em->persist($chat);
                $this->em->flush($chat);
                $this->redirect()->toRoute('chat');
            }
        }
        
        return array(
            'form' => $form,
        );
        
        /*
        $form = new ChatForm();
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $chat = new Chat();
            $form->setInputFilter($chat->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $chat->fromArray($form->getData());
                $chat->save($this->em);
                
                // Redirect to list of chats
                return $this->redirect()->toRoute('chat');
            }
        }
        
        return array(
            'form' => $form,
        );*/
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('chat', array(
                'action' => 'add',
            ));
        }
        
        // Get the Chat with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $chat = $this->getEntityManager()->find('Chatter\Entity\Chat', $id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('chat', array(
                'action' => 'index',
            ));
        }
        
        $form = new ChatEditForm($this->getEntityManager());
        $form->bind($chat);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($chat);
                $this->getEntityManager()->flush($chat);
                $this->redirect()->toRoute('chat');
            }
        }
        
        return array(
            'chat' => $chat,
            'form'  => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        // Get the Chat with the specified id. An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $chat = $this->getEntityManager()->find('Chatter\Entity\Chat', $id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('chat', array(
                'action' => 'index',
            ));
        }
        
        $chat->delete($this->getEntityManager());
        
        return $this->redirect()->toRoute('chat', array(
            'action' => 'index',
        ));
    }
}