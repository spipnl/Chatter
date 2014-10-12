<?php
namespace Chatter\Entity;

/**
 * @\Doctrine\ORM\Mapping\MappedSuperclass
 */
class Message {
    /**
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;
    
    /** @\Doctrine\ORM\Mapping\Column(type="string") */
    protected $text;
    
    /** @\Doctrine\ORM\Mapping\Column(type="datetime") */
    protected $date_created;
    
    /** @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="User", inversedBy="messages") */
    protected $user;
    
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
     * Set the text
     * 
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    /**
     * Get the text
     * 
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Set the creation date
     * 
     * @param DateTime $text
     */
    public function setDateCreated(\DateTime $date_created)
    {
        $this->date_created = $date_created;
    }
    
    /**
     * Get the creation date
     * 
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }
    
    /**
     * Allow null to remove association
     *
     * @param User $user
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
    }
    
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
