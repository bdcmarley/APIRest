<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;

class AdminController extends Controller
{

  /**
   * @Route("/admin", name="admin")
   * @Method({"GET"})
   */
  public function indexAction(Request $request)
  {
    return $this->render('admin/index.html.twig');
  }

  /**
   * @Route("/admin/create", name="admin_create")
   * @Method({"GET"})
   */
  public function addAction(Request $request)
  {
    // On crée un objet Advert
    $advert = new Article();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $articles);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('title',     TextType::class)
      ->add('content',   TextareaType::class)
      ->add('img',       FileType::class)
      ->add('category',  ChoiceType::class)
      ->add('number',    NumberType::class)
      ->add('price',     NumberType::class)
      ->add('mark',      ChoiceType::class)
      ->add('date',      DateType::class)
      ->add('save',      SubmitType::class)
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('admin/index.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
