<?php
namespace Chatter\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="chat")
 */
class Chat {
    /**
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;
    
    /** @\Doctrine\ORM\Mapping\Column(type="string") */
    protected $title;
    
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
     * Set the title
     * 
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Get the title
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
