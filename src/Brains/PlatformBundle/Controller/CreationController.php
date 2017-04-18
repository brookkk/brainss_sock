<?php

namespace Brains\PlatformBundle\Controller;

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

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;

class CreationController extends Controller
{
    public function indexAction()
    {
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    }

//Action pour ajout d'une nouvelle Année (exp : short= TC : nome(nomenclature) = Tronc Commun)
    public function n_anneeAction(Request $request)
    {
//nouvelle instance de l'entité Année
$annee= new Annee();

//creation du builder
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $annee);

//creation du formulaire
$form=$formBuilder
      ->add('short',   TextType::class)
      ->add('nome',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

//si le formulaire est bien rempli, on l'enregistre dans la BD
if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($annee);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Année Bien enregistrée.');

        return $this->redirectToRoute('brains_platform_homepage');
    }
}

//sinon (ou bien premier landing sur le form), on affiche le formulaire
return $this->render('BrainsPlatformBundle:New:year.html.twig', array(
 'form'=>$form->createView(),
  ));

    }




public function n_filiereAction(Request $request)
    {
        

$filiere= new Filiere();

//creation du builder
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $filiere);

//creation du formulaire
$form=$formBuilder
      ->add('short',   TextType::class)
      ->add('nome',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

//si le formulaire est bien rempli, on l'enregistre dans la BD
if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($filiere);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Filiere Bien enregistrée.');

        return $this->redirectToRoute('brains_platform_homepage');
    }
}

//sinon (ou bien premier landing sur le form), on affiche le formulaire
return $this->render('BrainsPlatformBundle:New:filiere.html.twig', array(
 'form'=>$form->createView(),
  ));



    }



 }



?>
