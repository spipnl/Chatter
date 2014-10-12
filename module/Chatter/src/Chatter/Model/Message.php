<?php
namespace Chatter\Model;

use Chatter\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="message",options={"engine"="InnoDB","collate"="utf8_general_ci"})
 */
class Message extends Entity\Message
{
}