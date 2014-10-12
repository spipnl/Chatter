<?php
namespace Chatter\Model;

use Chatter\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table(name="user",options={"engine"="InnoDB","collate"="utf8_general_ci"})
 */
class User extends Entity\User
{
}