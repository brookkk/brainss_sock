<?php

namespace Brains\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Brains\UserBundle\Entity\User;


class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirectToRoute('brains_platform_homepage');
    }

    // Le service authentication_utils permet de récupérer le nom d'utilisateur
    // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
    // (mauvais mot de passe par exemple)
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('BrainsUserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }

  public function profileAction()
  {
    //return $this->render('BrainsUserBundle:Security:user.html.twig');
    return $this->render('BrainsUserBundle:User:show_user.html.twig');
  }

  public function update_userAction(Request $request)
  {



$user= $this->get('security.token_storage')->getToken()->getUser();


//un nouvel utilisateur
//$user= new User();

//associer un new form builder au USER
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

//champs du form builder : année et filière (listes déroulantes) + submit
$form=$formBuilder
      ->add('annee', ChoiceType::class, array(
            'choices'=>array(
                  'tronc commun'=>'TC',
                  '1Bac'=>'1B',
                  '2Bac'=>'2B',
              ))
        )
      ->add('filiere', ChoiceType::class, array(
            'choices'=>array(
                  'Science'=>'science',
                  'Sciences Math'=>'SM',
                  'Sciences Physiques'=>'SP',
              ))
      )
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

//$form= $formBuilder ->getForm();


if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Utilisateur Bien enregistré.');

        return $this->redirectToRoute('brains_platform_homepage');
    }
}



//génération du form

//redirection vers la view qui va afficher le form
return $this->render('BrainsUserBundle:User:update.html.twig', array(
 'form'=>$form->createView(),
  ));


  }

}
