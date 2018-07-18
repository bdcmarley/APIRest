<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 */
class Users
{
    /**
    * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\Column(type="text")
    *
    * @Serializer\Groups({"detail", "list"})
    */
    private $username;

    /**
     * @ORM\Column(type="text")
     *
     * @Serializer\Groups({"detail"})
     */
    private $name;


    /**
     * @ORM\Column(type="text")
     *
     * @Serializer\Groups({"detail"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="text")
     */
    private $password;

    /**
     * @ORM\Column(type="text")
     *
     * @Serializer\Groups({"detail"})
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verif;

    /**
    * @ORM\Column(type="boolean")
    */
    private $admin = false;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="users", cascade={"persist"})
     *
     * @Serializer\Groups({"panier"})
     */
    private $article;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getVerif()
    {
        return $this->verif;
    }

    public function setVerif($verif)
    {
        $this->verif = $verif;
    }

    public function getArticle()
    {
        return $this->article;
    }
    public function setArticle($article)
    {
        $this->article = $article;
    }
}
