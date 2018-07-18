<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 *
 */
class Image
{

     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\Column(type="string")
    *
    * @Assert\NotBlank(message="Ajouter une image jpg")
    * @Assert\File(mimeTypes={ "image/jpeg", "image/gif", "image.pjpeg", "image.png" })
    */
    private $path;

    /**
    * @ORM\ManyToOne(targetEntity="Article", inversedBy="img"))
    */
   private $article;

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
    public function getArticle()
    {
      return $this->article;
    }

    public function setArticle($article)
    {
      $this->article = $article;

      return $this;
    }

}
