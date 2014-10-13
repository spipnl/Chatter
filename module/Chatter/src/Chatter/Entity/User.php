<?php
namespace Chatter\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="user",options={"engine"="InnoDB","collate"="utf8_general_ci"})
 */
class User {
    /**
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;
    
    /** @\Doctrine\ORM\Mapping\Column(type="string") */
    protected $name;
    
    /** @\Doctrine\ORM\Mapping\OneToMany(targetEntity="Message", mappedBy="user", cascade={"persist"}) */
    protected $messages;
    
    /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }
    
    /**
     * Get the id
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set the name
     * 
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Get the name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param Collection $messages
     */
    public function addMessages(Collection $messages)
    {
        foreach ($messages as $message) {
            $message->setUser($this);
            $this->messages->add($message);
        }
    }
    
    /**
     * @param Collection $messages
     */
    public function removeMessages(Collection $messages)
    {
        foreach ($messages as $message) {
            $message->setUser(null);
            $this->messages->removeElement($message);
        }
    }
    
    /**
     * @return Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
