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
use Brains\PlatformBundle\Entity\Exercice;

class ExerciceController extends Controller
{
    public function indexAction()
    {
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    }





public function n_exerciceAction(Request $request)
    {
        

$exercice= new Exercice();

//$annees=new Annee();

$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Annee');

    $listAnnees = $repository->findAll();

//creation du builder
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $exercice);

//creation du formulaire
$form=$formBuilder
      ->add('nom',   TextType::class)
      ->add('public',   TextType::class)
      ->add('annee',  new Annee())
      ->add('filiere',   TextType::class)
      ->add('auteur',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

//si le formulaire est bien rempli, on l'enregistre dans la BD
if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($exercice);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');

        return $this->redirectToRoute('BP_show_filiere');
    }
}

//sinon (ou bien premier landing sur le form), on affiche le formulaire
return $this->render('BrainsPlatformBundle:New:exercice.html.twig', array(
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
