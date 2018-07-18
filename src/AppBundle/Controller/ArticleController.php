<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use JMS\Serializer\SerializationContext;


class ArticleController extends Controller
{

  public function indexAction()
  {
    return true;
  }

  /**
   * @Route("/articles/{id}", name="article_show")
   */
   public function showAction(Article $article)
   {
       $data = $this->get('jms_serializer')->serialize($article, 'json', SerializationContext::create()->setGroups(array('detail')));

       $response = new Response($data);
       $response->headers->set('Content-Type', 'application/json');
       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
   }


    /**
     * @Route("/articles", name="articles_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
      $article = new Article();
      // die();
      $em = $this->getDoctrine()->getManager();
      $data = json_decode($request->getContent(), true);
      foreach ($data as $key => $value) {
        $set = 'set'.ucfirst($key);
        $article->$set($value);
      }
      $em->persist($article);
      $em->flush();
      $id = $article->getId();

      $response = new Response($id, Response::HTTP_CREATED);
      return $response;
    }

   /**
    * @Route("/img", name="articles_img")
    * @Method("POST")
    **/
    public function storeImage(Request $request)
    {
        $data = $request->files;
        $id = intval($request->request->get('article_id'));

        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->findOneById($id);

        for($i = 0; $i < count($request->files); $i++)
        {
            $name = "file" . $i;
            $ext = "." . $request->files->get($name)->getClientOriginalExtension();
            $file = $request->files->get("file" . $i);
            $path = "picture/" . uniqid((string)(rand()*5)) . $ext;
            move_uploaded_file($file ,$path);
            $em = $this->getDoctrine()->getManager();
            $image = new Image();
            $image->setPath("http://localhost:8000/" . $path);
            $article->addImg($image);
            $em->persist($image);
            $em->flush();
        }

        $response = new Response("Parfait", Response::HTTP_CREATED);
        return $response;
    }

    /**
     * @Route("/articl", name="article_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        $data = $this->get('jms_serializer')->serialize($article, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}
