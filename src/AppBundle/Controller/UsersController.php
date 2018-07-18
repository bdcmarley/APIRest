<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;


class UsersController extends Controller
{
   /**
   * @Route("/users/{id}", name="users_show")
   */
   public function showAction(Users $users)
   {
       $serializer = SerializerBuilder::create()->build();
       $data = $serializer->serialize($users, 'json');

       $response = new Response($data);
       $response->headers->set('Content-Type', 'application/json');
       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
   }


   /**
   * @Route("/users", name="users_create")
   * @Method({"GET"})
   */
   public function createAction(Request $request)
   {
       $data = $request->getContent();
       $users = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Users', 'json');

       $em = $this->getDoctrine()->getManager();
       $em->persist($user);
       $em->flush();

       return new Response('', Response::HTTP_CREATED);
   }
}
