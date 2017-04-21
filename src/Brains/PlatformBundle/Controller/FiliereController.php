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

class FiliereController extends Controller
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

        return $this->redirectToRoute('BP_show_filiere');
    }
}

//sinon (ou bien premier landing sur le form), on affiche le formulaire
return $this->render('BrainsPlatformBundle:New:filiere.html.twig', array(
 'form'=>$form->createView(),
  ));



    }

    //Action pour Afficher toutes les filières existantes
  public function show_filiereAction(Request $request)
  {

    $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

    $listFilieres = $repository->findAll();
 
    if (null === $listFilieres) {
      throw new NotFoundHttpException("Aucune filière na été trouvée");
        }

    return $this->render('BrainsPlatformBundle:Show:filiere.html.twig', array(
      'listFilieres' => $listFilieres    ) );
  }



         public function update_filiereAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

$filiere = $repository->find($id);

 

if (null === $filiere) {
      throw new NotFoundHttpException("Votre filière na pas été trouvée");
    }



$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $filiere);

$form=$formBuilder
      ->add('short',   TextType::class)
      ->add('nome',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($filiere);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Filière Bien enregistrée.');

        return $this->redirectToRoute('BP_show_filiere');
    }
}

return $this->render('BrainsPlatformBundle:New:filiere.html.twig', array(
 'form'=>$form->createView(),
  ));
 

    }



         public function delete_filiereAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

$filiere = $repository->find($id);
 
if (null === $filiere) {
      throw new NotFoundHttpException("Votre filière na pas été trouvée");
    }
 
        $em= $this->getDoctrine()->getManager();
        $em->remove($filiere);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Filière a été supprimée');

        return $this->redirectToRoute('BP_show_filiere');
 
 
    }



 }



?>
