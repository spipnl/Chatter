<?php
namespace Chatter\Model;

use Chatter\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="chat",options={"engine"="InnoDB","collate"="utf8_general_ci"})
 */
class Chat extends Entity\Chat
{
}