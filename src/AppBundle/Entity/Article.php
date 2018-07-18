<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Image;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 *
 */
class Article
{

     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="article", cascade={"persist"})
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $img;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $category_id;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"detail"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $mark_id;

    /**
    * @ORM\Column(type="datetime")
    * @Serializer\Groups({"detail", "list"})
    */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="Users", inversedBy="article")
    */
   private $users;

   public function __construct()
   {
     $this->date = new \DateTime();
   }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function addImg(Image $img): self
    {
      if (!$this->img->contains($img))
      {
          $this->img[] = $img;
          $img->setArticle($this);
      }
      return $this;
    }

    public function getCategoryid()
    {
        return $this->category_id;
    }

    public function setCategoryid($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getMarkid()
    {
        return $this->mark_id;
    }

    public function setMarkid($mark_id)
    {
        $this->mark_id = $mark_id;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }


    public function getUsers()
    {
        return $this->users;
    }

    public function setUsers(Author $users)
    {
        $this->users = $users;
    }

}
